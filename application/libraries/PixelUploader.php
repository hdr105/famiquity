<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImageUpload
 *
 * @author Saqib Ahmad
 */
class PixelUploader {

    private $_height, $_width, $_filename, $_element, $_path, $_completePath, $_fullName, $_error, $_isError, $_finalName, $_data;
    function getData() {
        return $this->_data;
    }

    function getFinalName() {
        return $this->_finalName;
    }

    function getError() {
        return $this->_error;
    }

    function getIsError() {
        return $this->_isError;
    }

    function setError($error) {
        $this->_error = $error;
    }

    function setIsError($isError) {
        $this->_isError = $isError;
    }

    function getHeight() {
        return $this->_height;
    }

    function getWidth() {
        return $this->_width;
    }

    function getFilename() {
        return $this->_filename;
    }

    function getElement() {
        return $this->_element;
    }

    function getPath() {
        return $this->_path;
    }

    function getCompletePath() {
        return $this->_completePath;
    }

    function getFullName() {
        return $this->_fullName;
    }

    function setHeight($height) {
        $this->_height = $height;
    }

    function setWidth($width) {
        $this->_width = $width;
    }

    function setFilename($filename) {
        $this->_filename = $filename;
    }

    function setElement($element) {
        $this->_element = $element;
    }

    function setPath($path) {
        $this->_path = $path;
    }

    function setCompletePath($completePath) {
        $this->_completePath = $completePath;
    }

    function setFullName($fullName) {
        $this->_fullName = $fullName;
    }

    public function uploadImage() {
        $this->_finalName = "";
        $this->generateDirectory();

        $ci = &get_instance();
        $config['upload_path'] = $this->_path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 10000;
        $config['max_width'] = 6000;
        $config['max_height'] = 6000;
        $config['file_name'] = $this->_filename;

        $ci->load->library('upload');
        $ci->upload->initialize($config);
        if (!$ci->upload->do_upload($this->_element)) {
            $this->_error = $ci->upload->display_errors();
            $this->_isError = TRUE;
            return NULL;
        }
        $this->_isError = FALSE;
        $this->_data = (object) $ci->upload->data();
        $imageHeight = $this->_data->image_height;
        if ((int) $imageHeight > (int) $this->_height) {
            $this->generateThumb($this->_data, (int) $this->_height);
        }
        $this->_fullName = $this->_data->full_path;
        $this->_completePath = $this->_data->file_path;
        $this->_finalName = $this->_data->file_name;
    }
    public function uploadDocument() {
        $this->_finalName = "";
        $this->generateDirectory();

        $ci = &get_instance();
        $config['upload_path'] = $this->_path;
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['max_size'] = 10000;
        $config['file_name'] = $this->_filename;
        $config['encrypt_name'] = FASLE;

        $ci->load->library('upload');
        $ci->upload->initialize($config);
        if (!$ci->upload->do_upload($this->_element)) {
            $this->_error = $ci->upload->display_errors();
            $this->_isError = TRUE;
            return NULL;
        }
        $this->_isError = FALSE;
        $this->_data = (object) $ci->upload->data();
        $imageHeight = $this->_data->image_height;
        if ((int) $imageHeight > (int) $this->_height) {
            $this->generateThumb($this->_data, (int) $this->_height);
        }
        $this->_fullName = $this->_data->full_path;
        $this->_completePath = $this->_data->file_path;
        $this->_finalName = $this->_data->file_name;
    }

    private function generateDirectory() {
        if (!file_exists($this->_path)) {
            mkdir($this->_path, 0745, true);
        }
    }

    public function generateThumb($data, $height, $width = 1280) {
        $ci = &get_instance();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $data->full_path;
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $width;
        $config['height'] = $height;
        $config['master_dim'] = "height";
        $config['new_image'] = $data->file_path . $data->file_name;

        $ci->load->library('image_lib');
        $ci->image_lib->initialize($config);
        $ci->image_lib->resize();
    }
    
    public function generateIcons($path, $size, $cap) {
        $ci = &get_instance();
        $this->_path = $path.$size."/".$cap."/";
        $this->generateDirectory();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $this->_data->full_path;
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $size;
        $config['height'] = $size;
        $config['overwrite'] = TRUE;
        $config['master_dim'] = "height";
        $config['new_image'] = $path.$size."/".$cap."/". $this->_data->file_name;

        $ci->load->library('image_lib');
        $ci->image_lib->initialize($config);
        $ci->image_lib->resize();
    }

}
