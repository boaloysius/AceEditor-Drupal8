<?php

namespace Drupal\ace_editor\Plugin\Editor;

use Drupal\Core\Form\FormStateInterface;
use Drupal\editor\Plugin\EditorBase;
use Drupal\editor\Entity\Editor;

/**
 * Defines BUEditor as an Editor plugin.
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


    public function getDefaultSettings() {
        $settings["default_editor"] = array(
            'theme' => array(
                '#type' => 'select',
                '#title' => t('Theme'),
                '#options' => $this->ace_editor_get_themes(),
                '#attributes' => array(
                    'style' => 'width: 150px;',
                ),
            ),
            'syntax' => array(
                '#type' => 'select',
                '#title' => t('Syntax'),
                '#description' => t('The syntax that will be highlighted.'),
                '#options' => $this->ace_editor_get_modes(),
                '#attributes' => array(
                    'style' => 'width: 150px;',
                ),
            ),
            'height' => array(
                '#type' => 'textfield',
                '#title' => t('Height'),
                '#description' => t('The height of the editor in either pixels or percents.
        You can use "auto" to let the editor calculate the adequate height.'),
                '#attributes' => array(
                    'style' => 'width: 100px;',
                ),
            ),
            'width' => array(
                '#type' => 'textfield',
                '#title' => t('Width'),
                '#description' => t('The width of the editor in either pixels or percents.'),
                '#attributes' => array(
                    'style' => 'width: 100px;',
                ),
            ),
            'font-size' => array(
                '#type' => 'textfield',
                '#title' => t('Font size'),
                '#description' => t('The the font size of the editor.'),
                '#attributes' => array(
                    'style' => 'width: 100px;',
                ),
            ),
            'linehighlighting' => array(
                '#type' => 'checkbox',
                '#title' => t('Line highlighting'),
            ),
            'line-numbers' => array(
                '#type' => 'checkbox',
                '#title' => t('Show line numbers'),
            ),
        );

        return $settings["default_editor"];
    }


    public function settingsForm(array $form, FormStateInterface $form_state, Editor $editor){

        $form[] = $this->getDefaultSettings();
        return $form;
    }

    public function settingsFormValidate(array $form, FormStateInterface $form_state) {

    }


    public function getLibraries(Editor $editor)
    {
        return array();
    }

    public function getJSSettings(Editor $editor)
    {
        return array();
    }

    public function settingsFormSubmit(array $form, FormStateInterface $form_state) {
        return $form;
    }



    ///////////////////////////////////////////////////////////////////////////////////////////////////


    /**
     * Returns the installed themes.
     */
    public function ace_editor_get_themes() {
        // Available themes are loaded on installation.
        $assets = array('theme' => array('cobalt' => 'Cobalt'));
        $themes = $assets['theme'];
        asort($themes);
        return $themes;
    }

    /**
     * Returns all of the modes.
     */
    public function ace_editor_get_modes() {
        // Available modeses are loaded on installation.
        $assets = array('mode' => array('html' => 'HTML'));
        asort($assets['mode']);
        $modes = array_merge($assets['mode'], array(
            // Translate some most used languages to their common name.
            'c_cpp' => 'C/C++',
            'coffee' => 'CoffeeScript',
            'csharp' => 'C#',
            'css' => 'CSS',
            'html' => 'HTML',
            'json' => 'JSON',
            'less' => 'LESS',
            'php' => 'PHP',
            'scss' => 'SCSS',
            'xml' => 'XML',
            'yaml' => 'YAML',
        ));
        return $modes;
    }



}
