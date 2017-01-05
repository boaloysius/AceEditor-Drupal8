<?php

namespace Drupal\ace_editor\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
* Plugin implementation of the 'compro_custom_file_link' formatter
*
* @FieldFormatter(
* id = "compro_custom_file_link",
* label = @Translation("Link"),
* field_types = {
* "text_with_summary"
* }
* )
*/
class ComproCustomFileLink extends FormatterBase {

    /**
    * Defines the default settings for this plugin.
    *
    * @return array
    * A list of default settings, keyed by the setting name.
    */
    public static function defaultSettings() {
        return array(
            'compro_custom_link_title' => '',
            ) + parent::defaultSettings();
        }

    /**
     * Returns a form to configure settings for the formatter.
     *
     * Invoked from \Drupal\field_ui\Form\EntityDisplayFormBase to allow
     * administrators to configure the formatter. The field_ui module takes care
     * of handling submitted form values.
     *
     * @param array $form
     * The form where the settings form is being included in.
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     * The current state of the form.
     *
     * @return array
     * The form elements for the formatter settings.
     */
    public function settingsForm(array $form, FormStateInterface $form_state) {
        $form = parent::settingsForm($form, $form_state);

        $form['compro_custom_link_title'] = array(
            '#type' => 'textfield',
            '#title' => t('Link title'),
            '#description' => t('Enter an optional link title to be shown instead of file name'),
            '#default_value' => $this->getSetting('compro_custom_link_title'),
        );

        return $form;
    }

    /**
     * Returns a short summary for the current formatter settings.
     *
     * If an empty result is returned, a UI can still be provided to display
     * a settings form in case the formatter has configurable settings.
     *
     * @return string[]
     * A short summary of the formatter settings.
     */
    public function settingsSummary() {
        $summary = array();
        $summary[] = t('Displays a title link');
        return $summary;
    }

    /**
     * Builds a renderable array for a field value.
     *
     * @param \Drupal\Core\Field\FieldItemListInterface $items
     * The field values to be rendered.
     * @param string $langcode
     * The language that should be used to render the field.
     *
     * @return array
     * A renderable array for $items, as an array of child elements keyed by
     * consecutive numeric indexes starting from 0.
     */
    public function viewElements(FieldItemListInterface $items, $langcode) {
        $elements = array();

        // Loop through items
        foreach ($items as $delta => $file) {
            $file = $file->entity;
            $url = Url::fromUri($file->url() );
            $file_link = \Drupal::l($this->getSetting('compro_custom_link_title') !== NULL ?
                $this->getSetting('compro_custom_link_title') : $file->getFileName(), $url);
            $elements[$delta] = array(
                '#markup' => $file_link,
            );
        }

        return $elements;
    }
}

?>