<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'homeController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*Started 10th April, 2018 */
/*Auth and Rg Routes */
$route['sign-up'] = 'registrationController/signUpPage';
$route['accept-terms-and-conditions'] = 'registrationController/signUpTermsPage';
$route['do-sign-up'] = 'registrationController/signUp';
$route['sign-in'] = 'authenticationController/signInPage';
$route['do-sign-in'] = 'authenticationController/signIn';
$route['sign-out'] = 'authenticationController/signOut';
$route['change-password'] = 'authenticationController/changePasswordPage';
$route['update-password'] = "authenticationController/updatePassword";
$route['forgot-password'] = "authenticationController/forgotPasswordPage";
$route['reset-password'] = "authenticationController/resetPassword";
$route['activate-account/(:any)'] = "registrationController/activateAccount/$1";
$route['complete-registration/(:any)'] = "registrationController/completeRegistrationPage/$1";
$route['save-registration'] = "registrationController/completeRegistration";

/*Auth and Rg Routes Ended*/

$route['lawyer-sign-up'] = 'registrationController/signUpLawyerPage';
$route['do-sign-up-lawyer'] = 'registrationController/signUpLawyer';
$route['fa-sign-up'] = 'registrationController/signUpFAPage';
$route['do-sign-up-fa'] = 'registrationController/signUpFA';
$route['registration-completed'] = 'registrationController/registrationCompletePage';

$route['list-users'] = 'myAccountController/usersListPage';
$route['list-users/(:num)'] = 'myAccountController/usersListPage';
$route['list-client'] = 'myAccountController/clientListPage';
$route['list-client/(:num)'] = 'myAccountController/clientListPage';
$route['edit-user/(:num)'] = 'myAccountController/editUserPage/$1';
$route['update-user'] = 'myAccountController/updateUser';

$route['questions-list'] = 'myAccountController/questionListPage';
$route['questions-list/(:num)'] = 'myAccountController/questionListPage';
$route['edit-question/(:num)'] = 'myAccountController/editQuestionPage/$1';
$route['update-question'] = 'myAccountController/updateQuestionPage';
$route['life-decision-ordering'] = 'myAccountController/chnageTypeOrdering/decisions';
$route['relationship-ordering'] = 'myAccountController/chnageTypeOrdering/relationship_status';
$route['update-ordering'] = 'myAccountController/updateTypeOrdering';


$route['list-institutes'] = 'myAccountController/instituteListPage';
$route['list-institutes/(:num)'] = 'myAccountController/instituteListPage';
$route['edit-institute/(:num)'] = 'myAccountController/editInstitutePage/$1';
$route['update-institute'] = 'myAccountController/updateInstitute';
$route['add-institute'] = 'myAccountController/addInstitutePage';
$route['create-institute'] = 'myAccountController/createInstitute';

$route['success-message'] = 'registrationController/successMessagePage';
$route['fa-onbording'] = 'registrationController/addFAsPage';
$route['import-fa'] = 'registrationController/importFA';
$route['add-advisor'] = 'registrationController/addAdvisorPage';
$route['create-advisor'] = 'registrationController/addAdvisor';

$route['import-clients'] = 'registrationController/importEndUserPage';
$route['import-endusers'] = 'registrationController/importEndUser';
$route['add-client'] = 'registrationController/addClientPage';
$route['create-client'] = 'registrationController/addClient';

$route['temp-app'] = 'questionnaireController/createSessionApplication';
$route['life-decision'] = 'questionnaireController/startQuestionPage';
$route['create-application'] = 'questionnaireController/createApplication';
$route['relationship-status'] = 'questionnaireController/relationShipPage';
$route['save-relationship-status'] = 'questionnaireController/saveRelationShip';
$route['income-info'] = 'questionnaireController/getIncomePage';
$route['save-income-info'] = 'questionnaireController/getIncome';

$route['cohabitaion-info'] = 'questionnaireController/cohabitationInfoPage';
$route['save-cohabitaion-info'] = 'questionnaireController/cohabitationInfo';
$route['past-cohabitaion-info'] = 'payerReciepientController/cohabitationHomeValueInfoPage';
$route['save-past-cohabitaion-info'] = 'payerReciepientController/cohabitationHomeValueInfo';



$route['kids-basic-info'] = 'questionnaireController/basicKidsInfoPage';
$route['save-kids-basic-info'] = 'questionnaireController/basicKidsInfo';
$route['marriage-info'] = 'questionnaireController/marriageInfoPage';
$route['save-marriage-info'] = 'questionnaireController/marriageInfo';
$route['pension-info'] = 'payerReciepientController/pensionInfoPage';
$route['save-pension-info'] = 'payerReciepientController/pensionInfo';
$route['inheritance-info'] = 'payerReciepientController/inheritanceInfoPage';
$route['save-inheritance-info'] = 'payerReciepientController/inheritanceInfo';
$route['home-owner-info'] = 'payerReciepientController/homeOwnerInfoPage';
$route['save-home-owner-info'] = 'payerReciepientController/homeOwnerInfo';
$route['home-value-info'] = 'payerReciepientController/homeValueInfoPage';
$route['save-home-value-info'] = 'payerReciepientController/homeValueInfo';
$route['home-title-info'] = 'payerReciepientController/homeTitleInfoPage';
$route['save-home-title-info'] = 'payerReciepientController/homeTitleInfo';
$route['home-title-marriage-info'] = 'payerReciepientController/homeTitleMarraigeInfoPage';
$route['save-home-title-marriage-info'] = 'payerReciepientController/homeTitleMarraigeInfo';
$route['financial-info'] = 'payerReciepientController/financialInfoPage';
$route['save-financial-info'] = 'payerReciepientController/financialInfo';
$route['kids-other-partner-info'] = 'payerReciepientController/otherKidsInfoPage';
$route['save-kids-other-partner-info'] = 'payerReciepientController/otherKidsInfo';
$route['kids-info'] = 'payerReciepientController/kidsInfoPage';
$route['save-kids-info'] = 'payerReciepientController/kidsInfo';
$route['kids-activities-info'] = 'payerReciepientController/kidsActivitiesInfoPage';
$route['save-kids-activities-info'] = 'payerReciepientController/kidsActivitiesInfo';

$route['kids-communicate-info'] = 'payerReciepientController/kidsCommunicateInfoPage';
$route['save-kids-communicate-info'] = 'payerReciepientController/kidsCommunicateInfo';
$route['kids-dinner-info'] = 'payerReciepientController/kidsDinnerInfoPage';
$route['save-kids-dinner-info'] = 'payerReciepientController/kidsDinnerInfo';
$route['kids-homework-info'] = 'payerReciepientController/kidsHomeWorkInfoPage';
$route['save-kids-homework-info'] = 'payerReciepientController/kidsHomeWorkInfo';
$route['kids-doctor-info'] = 'payerReciepientController/kidsDoctorInfoPage';
$route['save-kids-doctor-info'] = 'payerReciepientController/kidsDoctorInfo';
$route['spouse-complaint-help'] = 'payerReciepientController/kidsHelpComplaintInfoPage';
$route['save-spouse-complaint-help'] = 'payerReciepientController/kidsHelpComplaintInfo';
$route['spouse-info'] = 'payerReciepientController/spouseInfoPage';
$route['save-spouse-info'] = 'payerReciepientController/spouseInfo';
$route['spouse-job-info'] = 'payerReciepientController/spouseJobInfoPage';
$route['save-spouse-job-info'] = 'payerReciepientController/spouseJobInfo';
$route['job-info'] = 'payerReciepientController/jobInfoPage';
$route['save-job-info'] = 'payerReciepientController/jobInfo';
$route['wedding-gift-info'] = 'payerReciepientController/weddingGidtInfoPage';
$route['save-wedding-gift-info'] = 'payerReciepientController/weddingGidtInfo';
$route['business-tax-info'] = 'payerReciepientController/busniessTaxInfoPage';
$route['save-business-tax-info'] = 'payerReciepientController/busniessTaxInfo';
$route['additional-business-info'] = 'payerReciepientController/additionalBusniessInfoPage';
$route['save-additional-business-info'] = 'payerReciepientController/additionalBusniessInfo';

$route['trust-info'] = 'payerReciepientController/trustInfoPage';
$route['save-trust-info'] = 'payerReciepientController/trustInfo';
$route['shift-work'] = 'payerReciepientController/shiftWorkInfoPage';
$route['save-shift-work'] = 'payerReciepientController/shiftWorkInfo';
$route['nights-without-spouse'] = 'payerReciepientController/nightsWithOutSpousePage';
$route['save-nights-without-spouse'] = 'payerReciepientController/nightsWithOutSpouse';
$route['have-date'] = 'payerReciepientController/haveDatePage';
$route['save-have-date'] = 'payerReciepientController/haveDate';
$route['nights-not-home'] = 'payerReciepientController/nightsNotHomePage';
$route['save-nights-not-home'] = 'payerReciepientController/nightsNotHome';
$route['spouse-nights-not-home'] = 'payerReciepientController/spouseNightsNotHomePage';
$route['save-spouse-nights-not-home'] = 'payerReciepientController/spouseNightsNotHome';
$route['nights-without-you'] = 'payerReciepientController/nightsWithOutYouPage';
$route['save-nights-without-you'] = 'payerReciepientController/nightsWithOutYou';
$route['drinks-per-week'] = 'payerReciepientController/drinksPerWeekPage';
$route['save-drinks-per-week'] = 'payerReciepientController/drinksPerWeek';
$route['drugs-info'] = 'payerReciepientController/drugsInfoPage';
$route['save-drugs-info'] = 'payerReciepientController/drugsInfo';
$route['addiction-info'] = 'payerReciepientController/addictionInfoPage';
$route['save-addiction-info'] = 'payerReciepientController/addictionInfo';
$route['hit-spouse-info'] = 'payerReciepientController/hitSpouseInfoPage';
$route['save-hit-spouse-info'] = 'payerReciepientController/hitSpouseInfo';
$route['hit-kids-info'] = 'payerReciepientController/hitKidsInfoPage';
$route['save-hit-kids-info'] = 'payerReciepientController/hitKidsInfo';
$route['dating-profile'] = 'payerReciepientController/datingProfileInfoPage';
$route['save-dating-profile'] = 'payerReciepientController/datingProfileInfo';
$route['slept-on-couch'] = 'payerReciepientController/slepOnCouchPage';
$route['save-slept-on-couch'] = 'payerReciepientController/slepOnCouch';
$route['has-relationship'] = 'payerReciepientController/hasRelationShipPage';
$route['save-has-relationship'] = 'payerReciepientController/hasRelationShip';
$route['house-liens'] = 'payerReciepientController/houseLiensPage';
$route['save-house-liens'] = 'payerReciepientController/houseLiens';
$route['loan-money'] = 'payerReciepientController/loanInfoPage';
$route['save-loan-money'] = 'payerReciepientController/loanInfo';
$route['your-social-class'] = 'payerReciepientController/socialClassPage';
$route['save-your-social-class'] = 'payerReciepientController/socialClass';
$route['spouse-social-class'] = 'payerReciepientController/spouseSocialClassPage';
$route['save-spouse-social-class'] = 'payerReciepientController/spouseSocialClass';
$route['confide'] = 'payerReciepientController/confideInfoPage';
$route['save-confide'] = 'payerReciepientController/confideInfo';
$route['influencer'] = 'payerReciepientController/influencerInfoPage';
$route['save-influencer'] = 'payerReciepientController/influencerInfo';
$route['inheritance-maintained'] = 'payerReciepientController/inheritanceMaintainedPage';
$route['save-inheritance-maintained'] = 'payerReciepientController/inheritanceMaintained';
$route['affectionate-salutation'] = 'payerReciepientController/affectionateSalutationPage';
$route['save-affectionate-salutation'] = 'payerReciepientController/affectionateSalutation';
$route['inherited-income'] = 'payerReciepientController/inheritedIncomePage';
$route['save-inherited-income'] = 'payerReciepientController/inheritedIncome';
$route['financial-control'] = 'payerReciepientController/financialControlPage';
$route['save-financial-control'] = 'payerReciepientController/financialControl';
$route['withheld-sex'] = 'payerReciepientController/withheldSexPage';
$route['save-withheld-sex'] = 'payerReciepientController/withheldSex';
$route['pet-abuse'] = 'payerReciepientController/petAbusePage';
$route['save-pet-abuse'] = 'payerReciepientController/petAbuse';
$route['ethnic-background'] = 'payerReciepientController/ethnicBackgroundPage';
$route['save-ethnic-background'] = 'payerReciepientController/ethnicBackground';

$route['automobile'] = 'payerReciepientController/automobilePage';
$route['save-automobile'] = 'payerReciepientController/automobile';
$route['other-autos'] = 'payerReciepientController/otherAutosPage';
$route['save-other-autos'] = 'payerReciepientController/otherAutos';
$route['collectables'] = 'payerReciepientController/collectablesPage';
$route['save-collectables'] = 'payerReciepientController/collectables';
$route['gadgets'] = 'payerReciepientController/gadgetsPage';
$route['save-gadgets'] = 'payerReciepientController/gadgets';
$route['bank-accounts'] = 'payerReciepientController/bankAccountsPage';
$route['save-bank-accounts'] = 'payerReciepientController/bankAccounts';
$route['crypto-currencies'] = 'payerReciepientController/cryptoCurrenciesPage';
$route['save-crypto-currencies'] = 'payerReciepientController/cryptoCurrencies';
$route['money-owed-to-you'] = 'payerReciepientController/moneyowedtoYouPage';
$route['save-money-owed-to-you'] = 'payerReciepientController/moneyowedtoYou';
$route['investments-stocks'] = 'payerReciepientController/investmentsStocksPage';
$route['save-investments-stocks'] = 'payerReciepientController/investmentsStocks';
$route['business-value-assets'] = 'payerReciepientController/businessvalueAssetsPage';
$route['save-business-value-assets'] = 'payerReciepientController/businessvalueAssets';
$route['disability-insurance'] = 'payerReciepientController/disabilityInsurancePage';
$route['save-disability-insurance'] = 'payerReciepientController/disabilityInsurance';
$route['personal-loans'] = 'payerReciepientController/personalLoansPage';
$route['save-personal-loans'] = 'payerReciepientController/personalLoans';
$route['personal-credit-line'] = 'payerReciepientController/personalcreditLinePage';
$route['save-personal-credit-line'] = 'payerReciepientController/personalcreditLine';
$route['credit-cards'] = 'payerReciepientController/creditCardsPage';
$route['save-credit-cards'] = 'payerReciepientController/creditCards';
$route['other-debt'] = 'payerReciepientController/otherDebtPage';
$route['save-other-debt'] = 'payerReciepientController/otherDebt';
$route['business-credit-line'] = 'payerReciepientController/businesscreditLinePage';
$route['save-business-credit-line'] = 'payerReciepientController/businesscreditLine';
$route['contact-us-info'] = 'PayerReciepientController/contactUsPage'; //junaid


$route['risk-report'] = 'payerReciepientController/riskReportPage';
$route['risk-report/(:num)'] = 'payerReciepientController/riskReportPage/$1';
$route['save-and-exit'] = 'payerReciepientController/saveAndExitPage';
$route['suspension'] = 'payerReciepientController/suspensionPage';


$route['assets-info'] = 'payerReciepientController/assetsInfoPage';
$route['save-assets-info'] = 'payerReciepientController/assetsInfo';
$route['asset-details-info'] = 'payerReciepientController/assetsDetailsPage';
$route['save-asset-details-info'] = 'payerReciepientController/assetsDetails';
$route['num-gifts'] = 'payerReciepientController/numGiftsPage';
$route['save-num-gifts'] = 'payerReciepientController/numGifts';
$route['gift-detail-info'] = 'payerReciepientController/gistDetailsPage';
$route['save-gift-detail-info'] = 'payerReciepientController/gistDetails';

$route['results'] = 'payerReciepientController/finishApplicationPage';
$route['view-application/(:num)'] = 'questionnaireController/applicationViewPage/$1';

$route['my-applications'] = 'endUserAccountController/applicationListPage';
$route['restart-application/(:num)'] = 'endUserAccountController/restartApplication/$1';
$route['restart-temp-application/(:num)'] = 'endUserAccountController/restartTempApplication/$1';

$route['advisors'] = 'homeController/advisorsPage';
$route['lawyers'] = 'homeController/lawyersPage';
$route['solution-sample'] = 'homeController/solutionSample';
$route['professions'] = 'homeController/professionsPage';
$route['wedding-gifts'] = 'homeController/giftsPage';
$route['faqs'] = 'homeController/faqsPage';
$route['faqs-lawyer'] = 'homeController/faqsLawyerPage';
$route['questionnaire-preview'] = 'homeController/questionnairePreviewPage';
$route['buy-gift'] = 'homeController/buyGiftPage';


$route['911'] = 'homeController/nine11Page';
$route['teacher'] = 'homeController/teacherPage';
$route['medical'] = 'homeController/medicalPage';
$route['executive'] = 'homeController/executivePage';
$route['finance'] = 'homeController/financePage';
$route['consultant'] = 'homeController/consultantPage';




$route['register'] = 'homeController/registerPage';
$route['create-activity'] = 'homeController/createActivity';
