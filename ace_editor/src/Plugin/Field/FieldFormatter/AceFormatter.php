<?php


namespace Drupal\ace_editor\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
* Plugin implementation of the 'sample_wkt' formatter.
*
* @FieldFormatter (
*   id = "ace_formatter",
*   label = @Translation("Ace Format"),
*   field_types = {
*     "text_with_summary"
*   }
* )
*/

class AceFormatter extends FormatterBase {

    public static function defaultSettings() {
        // Get default ace_editor configuration
        $config = \Drupal::config('ace_editor.settings')->get();
        return $config;
    }

    /**
     * {@inheritdoc}
     */
    public function settingsSummary() {
        $summary = array();
        $summary[] = t('Displays your code in an editor format');
        return $summary;

    }


    /**
    * {@inheritdoc}
    */
    public function settingsForm(array $form, FormStateInterface $form_state) {

        $settings = $this->getSettings();

        // $this->getSettings() will return values form defaultSettings() on first use.
        // afterwards it will return the forms saved configuration.

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
    public function viewElements(FieldItemListInterface $items, $langcode) {
        // Renders front-end of our formatter.
        $elements = array();
        $settings = $this->getSettings();

        foreach ($items as $delta => $item) {
            $elements[$delta] = array(
            '#type' => 'textarea',
            '#value' => $item->value,
                // Attach libraries as per the setting.
            '#attached' => array(
                'library' =>  array(
                    'ace_editor/formatter',
                    'ace_editor/theme.'.$settings['theme'],
                    'ace_editor/mode.'.$settings['syntax']
                 ),
                 'drupalSettings' => array(
                     // Pass settings variable ace_formatter to javascript.
                     'ace_formatter' => $settings
                 ),
            ),
            '#attributes'=>array(
                "class" => array("content"),
                "readonly" => "readonly",
            ),
            '#prefix' => "<div class='ace_formatter'>",
            '#suffix' => "<div>",


            );
        }
        return $elements;
    }

}