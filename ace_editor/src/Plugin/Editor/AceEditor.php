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
 *   supports_content_filtering = FALSE,
 *   supports_inline_editing = FALSE,
 *   is_xss_safe = TRUE,
 *   supported_element_types = {
 *     "textarea"
 *   }
 * )
 */

class AceEditor extends EditorBase {


    public function getForm($settings) {

        $config = \Drupal::config('ace_editor.settings');


        return array(
            'theme' => array(
                '#type' => 'select',
                '#title' => t('Theme'),
                '#options' => $config->get('theme'),
                '#attributes' => array(
                    'style' => 'width: 150px;',
                ),
                '#default_value' => $settings['theme']?: $config->get('default_theme'),
            ),
            'syntax' => array(
                '#type' => 'select',
                '#title' => t('Syntax'),
                '#description' => t('The syntax that will be highlighted.'),
                '#options' => $config->get('syntax'),
                '#attributes' => array(
                    'style' => 'width: 150px;',
                ),
                '#default_value' => $settings['syntax']?: $config->get('default_syntax'),
            ),
            'height' => array(
                '#type' => 'textfield',
                '#title' => t('Height'),
                '#description' => t('The height of the editor in either pixels or percents.
        You can use "auto" to let the editor calculate the adequate height.'),
                '#attributes' => array(
                    'style' => 'width: 100px;',
                ),
                '#default_value' => $settings['height']?:$config->get('height')
            ),
            'width' => array(
                '#type' => 'textfield',
                '#title' => t('Width'),
                '#description' => t('The width of the editor in either pixels or percents.'),
                '#attributes' => array(
                    'style' => 'width: 100px;',
                ),
                '#default_value' => $settings['width']?:$config->get('width')
            ),
            'font_size' => array(
                '#type' => 'textfield',
                '#title' => t('Font size'),
                '#description' => t('The the font size of the editor.'),
                '#attributes' => array(
                    'style' => 'width: 100px;',
                ),
                '#default_value' => $settings['font_size']?:$config->get('font_size')
            ),
            'linehighlighting' => array(
                '#type' => 'checkbox',
                '#title' => t('Line highlighting'),
                '#default_value' => isset($settings['linehighlighting'])? $settings['linehighlighting']:$config->get('linehighlighting')
            ),
            'line_numbers' => array(
                '#type' => 'checkbox',
                '#title' => t('Show line numbers'),
                '#default_value' => isset($settings['line_numbers']) ? $settings['line_numbers']:$config->get('line_numbers')
            ),
        );

    }


    public function settingsForm(array $form, FormStateInterface $form_state, Editor $editor){
        $settings = $editor->getSettings();
        $form = array();
        $form['fieldset'] = array(
            '#type' => 'fieldset',
            '#title' => t('Ace Editor Settings'),
            '#collapsable' => TRUE
        );
        $form['fieldset'] = array_merge($form['fieldset'], $this->getForm($settings['fieldset']));
        return $form;
    }

    public function settingsFormValidate(array $form, FormStateInterface $form_state) {

    }


    public function getLibraries(Editor $editor)
    {

        $config = $config = \Drupal::config('ace_editor.settings');

        $theme = trim($editor->getSettings()['fieldset']['theme']);
        $mode = trim($editor->getSettings()['fieldset']['syntax']);

        $theme_exist =  \Drupal::service('library.discovery')->getLibraryByName('ace_editor', 'theme.'.$theme);
        $mode_exist =  \Drupal::service('library.discovery')->getLibraryByName('ace_editor', 'mode.'.$mode);

        $libs=array("ace_editor/primary");

        if($theme_exist){
            $libs[] = "ace_editor/theme.".$theme;
        }else{
            $libs[] = "ace_editor/theme.".$config->get('default_theme_value');
        }

        if($mode_exist){
            $libs[] = "ace_editor/mode.".$mode;
        }else{
            $libs[] = "ace_editor/mode.".$config->get('default_syntax_value');
        }
        
        return $libs;
    }

    public function getJSSettings(Editor $editor)
    {
        return $editor->getSettings()['fieldset'];
    }

    public function settingsFormSubmit(array $form, FormStateInterface $form_state) {
        return $form;
    }




}
