<?php


namespace Drupal\ace_editor\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
* Plugin implementation of the 'sample_wkt' widget.
*
* @FieldWidget (
*   id = "sample_wkt",
*   label = @Translation("Sample Format"),
*   field_types = {
*     "text_with_summary"
*   },
*   settings = {
*     "placeholder" = "Sample Text"
*   }
* )
*/
class SampleWidget extends WidgetBase {

/**
* {@inheritdoc}
*/
    public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
        $element += array(
            '#type' => 'textarea',
            '#default_value' => $items[$delta]->value ?: NULL,
            '#placeholder' => $this->getSetting('placeholder'),
        );
        return array('value' => $element);
    }

}