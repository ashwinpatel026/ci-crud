<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImageUpload extends CI_Controller {


   /**
    * Manage __construct
    *
    * @return Response
   */
   public function __construct() { 
      parent::__construct(); 
      $this->load->helper(array('form', 'url')); 
   }


   /**
    * Manage index
    *
    * @return Response
   */
   public function index() { 
      $this->load->view('imageUploadForm', array('error' => '' )); 
   } 


   /**
    * Manage uploadImage
    *
    * @return Response
   */
   public function uploadImage() { 


      $config['upload_path']   = './uploads/'; 
      $config['allowed_types'] = 'gif|jpg|png'; 
      $config['max_size']      = 1024;
      $this->load->library('upload', $config);


      if ( ! $this->upload->do_upload('image')) {
         $error = array('error' => $this->upload->display_errors()); 
         $this->session->set_flashdata('error', 'Something went wrong. Please try again with valid format.');
         $this->load->view('imageUploadForm', $error); 
      }else { 


        $uploadedImage = $this->upload->data();
        $this->resizeImage($uploadedImage['file_name']);
        $this->session->set_flashdata('success','upload Images successfull.');
        redirect('ImageUpload');
        
        exit;
      } 
   }


   /**
    * Manage uploadImage
    *
    * @return Response
   */
   public function resizeImage($filename)
   {
      $source_path = './uploads/' . $filename;
      $target_path ='./uploads/thumbnail/';
      $config_manip = array(
          //'image_library' => 'gd2',
          'source_image' => $source_path,
          'new_image' => $target_path,
          'maintain_ratio' => TRUE,
          'create_thumb' => TRUE,
          'thumb_marker' => '_thumb',
          'width' => 150,
          'height' => 150
      );


      $this->load->library('image_lib', $config_manip);
      if (!$this->image_lib->resize()) {
          echo $this->image_lib->display_errors();
      }


      $this->image_lib->clear();
   }
}