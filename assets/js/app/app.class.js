(function(window) {
    function CommonFunc() {

        var _opt;
        var _self = this;
        var formId;
        var _selectedItem;
        var __construct = function() {

            checkCookie();
            openDeleteConfirmation();
            aodaFontChange();
            changeInvalidateClass();
            
        };
        
        this.checkValidation = function() {
            $('input[data-message]').each(function() {
                var $this = $(this);
                var invalid_message = $this.data('message')
                $this.on('invalid', function(e) {
                    $this.get(0).setCustomValidity(invalid_message);
                });
                $this.on('change', function(e) {
                    try {
                        $this.get(0).setCustomValidity('');
                    } catch (e) {

                    }
                });
            });

        };
        var foldNav = function(){
            
            $(".navbar-brand").click(function(){
                $("#aside").toggleClass("folded");
                $("#largeLogo").toggleClass("hide");
                $("#smallLogo").toggleClass("hide");
            });
        };
        var getProgrmsProjects = function(){
            $("#programs").change(function(e){ 
                getProgramProjectRoutine(this);
            });
        };
        this.updateProjects = function(){
            
            getProgramProjectRoutine($("#programs"));
        }
        var getProgramProjectRoutine = function(obj){
            
            var id = $(obj).find(':selected').val();
                //id = (id == '')?0:id;
                id = id ? id : 0;
                $('#projects').prop('disabled', "disabled");
                $("#projects").find('option').remove().end().append('<option value="">Please Select Program</option>').val('');
                
                $.getJSON(base_url+"program-projects/"+id, function(data) {
                    $("#projects option").remove();
                    
                    $.each(data, function(){
                        var selected = "";
                        if("undefined" !== typeof selectedProject){
                            selected = (selectedProject == this.id)?'selected="selected"':'';
                        }
                        $("#projects").append('<option value="'+ this.id +'" '+selected+'>'+ this.name +'</option>');
                    });
                    $('#projects').prop('disabled', false);
                    
                });
                
                
        };
        var getSubProjects = function(){
            $(".chain-project").change(function(e){
                getSubProjectRoutine(this);
            });
        };
        this.updateSubProjects = function(){
            
            getSubProjectRoutine($("#projects"));
        }
        var getSubProjectRoutine = function(obj){
            var id = $(obj).find(':selected').val();
                //id = (id == '')?0:id;
                id = id ? id : 0;
                $('#sub_projects').prop('disabled', "disabled");
                $.getJSON(base_url+"get-sub-projects/"+id, function(data) {
                    $("#sub_projects option").remove();
                    $.each(data, function(){
                        var selected = "";
                        if("undefined" !== typeof selectedSubProject ){
                            selected = (selectedSubProject == this.id)?'selected="selected"':'';
                        }
                        $("#sub_projects").append('<option value="'+ this.id +'" '+selected+'>'+ this.name +'</option>');
                    });
                    $('#sub_projects').prop('disabled', false);
                    
                });  
        };
        
        var changeInvalidateClass = function() {
            $('input[data-message]').blur(function(e) {
                var controlgroup = $(e.target);
                if (!e.target.checkValidity()) {
                    controlgroup.removeClass('form-control-success').addClass('form-control-danger');
                } else {
                    controlgroup.removeClass('form-control-danger').addClass('form-control-success');
                }
            });
        };
        /*Private Mthods*/
        
        var clearSearchForms = function(){
            $(".reset").on('click', function(e) {
             e.preventDefault();
             $(this).closest('form').find("input[type=text], textarea, input[type=hidden]").val("");   
            });
        };
        
        var printResults = function(){
            $(".print-pdf").on('click', function(e) {
                e.preventDefault();
                var url = base_url + $(this).data('url');
                $("#searchFrm").attr("action", url);
                $("#searchFrm").submit();
            });
        };
        
        var openDeleteConfirmation = function()
        {
            $('.modal-confirm').on('click', function(e) {
                var message = $(this).data('confirm');
                _self.formId = $(this).data('form');
                $("#confirm-model .modal-body").html(message);
                e.preventDefault();
                $('#confirm-model').modal({backdrop: 'static', keyboard: false})
                        .one('click', '#confirm_yes', function() {        
                    $("#"+_self.formId).submit();
                });

            });
        }
        var configureTipsy = function() {
            $('[data-toggle="tooltip"]').tooltip({ placement: 'right'});
        }
        var aodaFontChange = function() {
            var parhs = $(".aoda-enable").find("p");
            $(".inc-size").on("click", function() {
                var currentSize = $('body').css("font-size");
                var intFont = parseInt(currentSize.replace("px", ""));
                if (intFont < 32) {
                    $('body').css("font-size", (intFont + 1) + "px");
                }
            });
            $(".dec-size").on("click", function() {
                var currentSize = $('body').css("font-size");
                var intFont = parseInt(currentSize.replace("px", ""));
                if (intFont > 13) {
                    $('body').css("font-size", (intFont - 1) + "px");
                }

            });

        }
        var checkCookie = function()
        {
            var cookieEnabled = (navigator.cookieEnabled) ? true : false;

            if (cookieEnabled)
            {
                document.cookie = "areCookiesEnabled='';";
                var cookieEnabled = (document.cookie.indexOf("areCookiesEnabled") !== -1) ? true : false;
                document.cookie = 'areCookiesEnabled=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
            }

            if (!cookieEnabled) {
                window.location.href = base_url + "/no-cookies";

            }
        };
        var openHistroyTrail = function(){
            //open-trail
            $(".open-trail").on( "click", function(e) {
                
                e.preventDefault();
                var target = $(this).data('id');
                $("#"+target).show(1000);
                
            });
        };
        var openDonorSelector = function() {
            $(".open-donor-modal").on( "click", function(e) {
                
                e.preventDefault();
                $('#select-donor').modal();
                $("#find-donor").val("");
                $("#find-donor").focus();
                
            });
        };
        this.updateSelectedDonor = function(obj){
            $("#"+obj.selectButtion).on('click', function(){
                
                var selectedDonor = $("#" + obj.resultDiv).html();
                 $("#"+obj.displayDiv).html(selectedDonor);
                 $("#select-donor").modal('hide');
                 $(".open-donor-modal").html('Change Donor');
                 
                 if("undefined" !== typeof importDonnor){
                     var object = _self._selectedItem;
                     
                     $("#"+importDonnor.fn).val(object.first_name);
                     $("#"+importDonnor.ln).val(object.last_name);
                     $("#"+importDonnor.email).val(object.email);
                     $("#"+importDonnor.phone).val(object.home_phone);
                     
                     
                 }
                 
                 
            });
            
        };
        this.cityLookUp = function(obj) {

            $("#" + obj.cityLookupField).autocomplete({
                minLength: 3,
                maxResults: 5,
                source: base_url + "search-city/",
                focus: function(event, ui) {
                    $("#" + obj.cityLookupField).val(ui.item.label);
                    focusedItem = ui.item;
                    return false;
                },
                select: function(event, ui) {
                    $("#" + obj.cityLookupField).val(ui.item.label);
                    $("#" + obj.cityId).val(ui.item.value);
                    $("#" + obj.countryId).val(ui.item.country_id);
                    $("#" + obj.provinceId).val(ui.item.province_id);
                    return false;
                }
            })
                    .autocomplete("instance")._renderItem = function(ul, item) {
                return $("<li>")
                        .append("<a>" + item.label + "</a>")
                        .appendTo(ul);
            };

        };
        this.captionLookUp = function(obj) {
            var minLen = ("undefined" === typeof obj.minLength) ? 3 : obj.minLength;
            $("#" + obj.lookupField).autocomplete({
                minLength: minLen,
                maxResults: 5,
                source: base_url + obj.url,
                focus: function(event, ui) {
                    $("#" + obj.lookupField).val(ui.item.label);
                    focusedItem = ui.item;
                    return false;
                },
                select: function(event, ui) {
                    $("#" + obj.lookupField).val(ui.item.label.replace("\n", ", "));
                    $("#" + obj.idField).val(ui.item.value);
                    $("#" + obj.captionField).val(ui.item.caption);
                    return false;
                }
            })
                    .autocomplete("instance")._renderItem = function(ul, item) {
                return $("<li>")
                        .append("<a>" + item.label.replace("\n", "<br>") + "</a>")
                        .appendTo(ul);
            };

        };
        this.basicLookUp = function(obj) {
            var minLen = ("undefined" === typeof obj.minLength) ? 3 : obj.minLength;
            $("#" + obj.lookupField).autocomplete({
                minLength: minLen,
                maxResults: 5,
                source: base_url + obj.url,
                focus: function(event, ui) {
                    $("#" + obj.lookupField).val(ui.item.label);
                    focusedItem = ui.item;
                    return false;
                },
                select: function(event, ui) {
                    $("#" + obj.lookupField).val(ui.item.label.replace("\n", ", "));
                    $("#" + obj.idField).val(ui.item.value);
                    return false;
                }
            })
                    .autocomplete("instance")._renderItem = function(ul, item) {
                return $("<li>")
                        .append("<a>" + item.label.replace("\n", "<br>") + "</a>")
                        .appendTo(ul);
            };

        };
        
        this.donorLookUp = function(obj) {

            $("#" + obj.lookupField).autocomplete({
                minLength: 3,
                maxResults: 5,
                source: base_url + obj.url,
                focus: function(event, ui) {
                    $("#" + obj.lookupField).val(ui.item.label);
                    focusedItem = ui.item;
                    return false;
                },
                select: function(event, ui) {
                    $("#" + obj.lookupField).val(ui.item.label);
                    $("#" + obj.idField).val(ui.item.value);
                    $("#" + obj.selectButtion).removeClass('hidden');
                    $("#" + obj.resultDiv).html("<b><i>"+ ui.item.label 
                            + "</i><br>Donor Id: "+ui.item.refrence_id+"</b><br>Address:"  
                            + ui.item.address1+", "+ui.item.city_name +" "+  ui.item.postal_code
                            + "<br>T: "+ui.item.home_phone
                            + "<br>E: "+ui.item.email);
                    _self._selectedItem = ui.item;
                    return false;
                }
            })
                    .autocomplete("instance")._renderItem = function(ul, item) {
                return $("<li>")
                        .append("<a><b><i>" + item.label + "</i></b><br><b>Donor Id: "  + item.refrence_id + "</b> Address: "+ item.address1+", "+item.city_name+" "+item.postal_code + "<br>Phone: " + item.home_phone + "</a>")
                        .appendTo(ul);
            };
            this.updateSelectedDonor(obj);
        };
        this.AJAX = function(obj) {
            var request = $.ajax({
                url: base_url +obj.url,
                method: obj.method,
                data: obj.data,
                dataType: "json"
            });

            request.done(function(data) {
                return data;
            });

            request.fail(function(jqXHR, textStatus) {
                var data = {status:500, message: textStatus};
                return data;
            });
        };
        
        __construct();
    }


    /* -------------------------------------------------------------------------- */

    $(document).ready(function() {
        app = new CommonFunc();
        app.checkValidation();
        window.app = app;
        /*app.donorLookUp({
            lookupField: "find-donor",
            idField: "selected_donor_id",
            selectButtion: "sel_result_btn",
            resultDiv: "selected_result",
            displayDiv: "selected_result_display",
            url: "search-donor/"
        });*/

    });
})(window);