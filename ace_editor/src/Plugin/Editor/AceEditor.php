<?php

namespace Drupal\ace_editor\Plugin\Editor;

use Drupal\Core\Form\FormStateInterface;
use Drupal\editor\Plugin\EditorBase;
use Drupal\editor\Entity\Editor;

/**
 * Defines AceEditor as an Editor plugin.
 *
 * @Editor(
 *   id = "ace_editor",
 *   label = "Ace Editor",
 *   supports_content_filtering = TRUE,
 *   is_xss_safe = FALSE,
 *   supported_element_types = {
 *     "textarea"
 *   }
 * )
 */

class AceEditor extends EditorBase {

    /**
     * {@inheritdoc}
     */

    public function getDefaultSettings() {
        $config = \Drupal::config('ace_editor.settings')->get();
        return $config;
    }

    /**
     * Returns a settings form to configure this text editor.
     *
     * @param array $settings
     *   An array containing form configuration.
     *
     * @return array
     *   A primary render array for the settings form.
     */

    public function getForm($settings) {

        $config = \Drupal::config('ace_editor.settings');

        return array(
            'theme' => array(
                '#type' => 'select',
                '#title' => t('Theme'),
                '#options' => $config->get('theme_list'),
                '#attributes' => array(
                    'style' => 'width: 150px;',
                ),
                '#default_value' => $settings['theme'],
            ),
            'syntax' => array(
                '#type' => 'select',
                '#title' => t('Syntax'),
                '#description' => t('The syntax that will be highlighted.'),
                '#options' => $config->get('syntax_list'),
                '#attributes' => array(
                    'style' => 'width: 150px;',
                ),
                '#default_value' => $settings['syntax'],
            ),
            'height' => array(
                '#type' => 'textfield',
                '#title' => t('Height'),
                '#description' => t('The height of the editor in either pixels or percents.
        You can use "auto" to let the editor calculate the adequate height.'),
                '#attributes' => array(
                    'style' => 'width: 100px;',
                ),
                '#default_value' => $settings['height'],
            ),
            'width' => array(
                '#type' => 'textfield',
                '#title' => t('Width'),
                '#description' => t('The width of the editor in either pixels or percents.'),
                '#attributes' => array(
                    'style' => 'width: 100px;',
                ),
                '#default_value' => $settings['width']
            ),
            'font_size' => array(
                '#type' => 'textfield',
                '#title' => t('Font size'),
                '#description' => t('The the font size of the editor.'),
                '#attributes' => array(
                    'style' => 'width: 100px;',
                ),
                '#default_value' => $settings['font_size']
            ),
            'line_numbers' => array(
                '#type' => 'checkbox',
                '#title' => t('Show line numbers'),
                '#default_value' => $settings['line_numbers']
            ),
            'print_margins' => array(
                '#type' => 'checkbox',
                '#title' => t('Print Margins'),
                '#default_value' => $settings['print_margins']
            ),
            'show_invisibles' => array(
                '#type' => 'checkbox',
                '#title' => t('Show ... for better code matching'),
                '#default_value' => $settings['show_invisibles']
            ),

        );
    }

    /**
     * {@inheritdoc}
     */

    public function settingsForm(array $form, FormStateInterface $form_state, Editor $editor){

        $settings = $editor->getSettings();
        
        $form = array();

        $form['fieldset'] = array(
            '#type' => 'fieldset',
            '#title' => t('Ace Editor Settings'),
            '#collapsable' => TRUE
        );

        if(array_key_exists('fieldset',$settings)){
            $form['fieldset'] = array_merge($form['fieldset'], $this->getForm($settings['fieldset']));
        }else{
            $form['fieldset'] = array_merge($form['fieldset'], $this->getForm($settings));
        }

        return $form;
    }

    /**
     * {@inheritdoc}
     */

    public function settingsFormValidate(array $form, FormStateInterface $form_state) {

    }

    /**
     * {@inheritdoc}
     */

    public function getLibraries(Editor $editor)
    {
        // Get default ace_editor configutaion.
        $config = $config = \Drupal::config('ace_editor.settings');

        // Get theme and mode
        $theme = trim($editor->getSettings()['fieldset']['theme']);
        $mode = trim($editor->getSettings()['fieldset']['syntax']);

        // Check if theme and mode library exist.
        $theme_exist =  \Drupal::service('library.discovery')->getLibraryByName('ace_editor', 'theme.'.$theme);
        $mode_exist =  \Drupal::service('library.discovery')->getLibraryByName('ace_editor', 'mode.'.$mode);

        // ace_editor/primary the basic library for ace_editor.
        $libs=array("ace_editor/primary");

        if($theme_exist){
            $libs[] = "ace_editor/theme.".$theme;
        }else{
            $libs[] = "ace_editor/theme.".$config->get('theme');
        }

        if($mode_exist){
            $libs[] = "ace_editor/mode.".$mode;
        }else{
            $libs[] = "ace_editor/mode.".$config->get('syntax');
        }

        return $libs;
    }

    /**
     * {@inheritdoc}
     */

    public function getJSSettings(Editor $editor)
    {
        // Pass settings to javascript.
        return $editor->getSettings()['fieldset'];
    }

    /**
     * {@inheritdoc}
     */

    public function settingsFormSubmit(array $form, FormStateInterface $form_state) {
        return $form;
    }




}
