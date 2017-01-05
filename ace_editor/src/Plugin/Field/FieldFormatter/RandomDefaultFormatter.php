<?php

/**
 * @file
 * Contains \Drupal\Random\Plugin\Field\FieldFormatter\RandomDefaultFormatter.
 */

namespace Drupal\ace_editor\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'Random_default' formatter.
 *
 * @FieldFormatter(
 *   id = "Random_default",
 *   label = @Translation("Random text"),
 *   field_types = {
 *     "text_with_summary"
 *   }
 * )
 */
class RandomDefaultFormatter extends FormatterBase {

    /**
     * {@inheritdoc}
     */
    public function settingsSummary() {
        $summary = array();
        $settings = $this->getSettings();
        $summary[] = t('Displays the random string.');

        return $summary;
    }

    /**
     * {@inheritdoc}
     */
    public function viewElements(FieldItemListInterface $items, $langcode) {
        $element = array();

        foreach ($items as $delta => $item) {
            // Render each element as markup.
            $element[$delta] = array(
                '#type' => 'markup',
                '#markup' => $item->value,
            );
        }

        return $element;
    }
}