<?php


namespace Drupal\ace_editor\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
* Plugin implementation of the 'sample_wkt' formatter.
*
* @FieldFormatter (
*   id = "sample_wkt",
*   label = @Translation("Ace Editor format"),
*   field_types = {
*     "text_with_summary"
*   }
* )
*/

class SampleFormatter extends FormatterBase {

    public static function defaultSettings() {
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
            'linehighlighting' => array(
                '#type' => 'checkbox',
                '#title' => t('Line highlighting'),
                '#default_value' => $settings['linehighlighting']
            ),
            'line_numbers' => array(
                '#type' => 'checkbox',
                '#title' => t('Show line numbers'),
                '#default_value' => $settings['line_numbers']
            ),
        );

    }

    /**
    * {@inheritdoc}
    */
    public function viewElements(FieldItemListInterface $items, $langcode) {

        $elements = array();
        $settings = $this->getSettings();
        foreach ($items as $delta => $item) {
            $elements[$delta] = array(
            '#type' => 'markup',

                '#attached' => array(
                    'library' =>  array(
                        'ace_editor/formatter',
                        'ace_editor/theme.'.$settings['theme'],
                        'ace_editor/mode.'.$settings['syntax']
                    ),
                'drupalSettings' => array(
                    'ace_formatter' => $settings
                ),
                ),
            '#markup' => "<div class='ace_formatter'><div class = 'content'>".$item->value."</div></div>",

            );
        }
        return $elements;
    }

}