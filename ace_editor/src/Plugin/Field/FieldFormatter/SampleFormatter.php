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
        $config = \Drupal::config('ace_editor.settings');
        return array(
            'theme' => array(
                '#type' => 'select',
                '#title' => t('Theme'),
                '#options' => $config->get('theme'),
                '#attributes' => array(
                    'style' => 'width: 150px;',
                ),
                '#default_value' => $config->get('default_theme'),
            ),
            'syntax' => array(
                '#type' => 'select',
                '#title' => t('Syntax'),
                '#description' => t('The syntax that will be highlighted.'),
                '#options' => $config->get('syntax'),
                '#attributes' => array(
                    'style' => 'width: 150px;',
                ),
                '#default_value' => $config->get('default_syntax'),
            ),
            'height' => array(
                '#type' => 'textfield',
                '#title' => t('Height'),
                '#description' => t('The height of the editor in either pixels or percents.
        You can use "auto" to let the editor calculate the adequate height.'),
                '#attributes' => array(
                    'style' => 'width: 100px;',
                ),
                '#default_value' => $config->get('height')
            ),
            'width' => array(
                '#type' => 'textfield',
                '#title' => t('Width'),
                '#description' => t('The width of the editor in either pixels or percents.'),
                '#attributes' => array(
                    'style' => 'width: 100px;',
                ),
                '#default_value' => $config->get('width')
            ),
            'font_size' => array(
                '#type' => 'textfield',
                '#title' => t('Font size'),
                '#description' => t('The the font size of the editor.'),
                '#attributes' => array(
                    'style' => 'width: 100px;',
                ),
                '#default_value' => $config->get('font_size')
            ),
            'linehighlighting' => array(
                '#type' => 'checkbox',
                '#title' => t('Line highlighting'),
                '#default_value' => $config->get('linehighlighting')
            ),
            'line_numbers' => array(
                '#type' => 'checkbox',
                '#title' => t('Show line numbers'),
                '#default_value' => $config->get('line_numbers')
            ),
        ) + parent::defaultSettings();

    }

    /**
     * {@inheritdoc}
     */
    public function settingsSummary() {
        $summary = array();
        $summary[] = t('Displays your code in an editor format');
        return $summary;

    }

    public function getForm() {

        $form = static ::defaultSettings();
        $settings = $this->getSettings();
        $default_settings = $config = \Drupal::config('ace_editor.settings');
        dpm($default_settings->get());
        foreach ($form as $key => $value){
            $form[$key]['#default_value'] = $settings[$key]['#default_value'];
        }

        return $form;

    }


    /**
    * {@inheritdoc}
    */
    public function settingsForm(array $form, FormStateInterface $form_state) {
        $ace_formatter_form = $this->getForm();
        $elements = parent::settingsForm($form, $form_state);
        return $ace_formatter_form;


    }

    /**
    * {@inheritdoc}
    */
    public function viewElements(FieldItemListInterface $items, $langcode) {

        $elements = array();
        foreach ($items as $delta => $item) {
            $elements[$delta] = array(
            '#type' => 'markup',

                '#attached' => array(
                    'library' =>  array(
                        'ace_editor/formatter',
                        'ace_editor/theme.cobalt',
                        'ace_editor/mode.html'
                    ),
                'drupalSettings' => array(
                    'ace_formatter' => "cobalt"
                ),
                ),
            '#markup' => "<div class='ace_editor_formatter'>".$item->value."</div>",

            );
        }
        return $elements;
    }

}