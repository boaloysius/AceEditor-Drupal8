# AceEditor-Drupal8
This project port <a href="https://www.drupal.org/project/ace_editor">Ace Editor module for Drupal 7</a> to Drupal 8.
<br><a href="https://ace.c9.io/#nav=about">Ace Editor Library</a>
<h2>Components</h2>
  <ul>
  <li>Ace Editor</li>
  <li>Ace Formatter</li>
  <li>Ace Filter</li>
  </ul>
<div>
  <h2>How to use this module</h2>
  <ul>
  <li><h3>Editor</h3></li>
  <li>Install this module</li>
  <li>Goto example.com/admin/config/content/formats and select a format eg: Full HTML</li>
  <li>Select Ace Editor from 'Text Editor'</li>
  <li>Save Settings</li>
  <li>Goto example.com/node/add/article and in the text formatter field select the just opted format eg: Full HTML</li>
  <li>You can see the editor appearing</li>
  
  <li><h3>Formatter</h3></li>
  <li> Select display settings of any content type eg: Goto example.com/admin/structure/types/manage/article/display</li>
  <li>Select a field of type "text_with_summary" eg: boby field in freshly installed drupal</li>
  <li>From format option select 'Ace Format' and select the gear button appered</li>
  <li>Change the formatter settings if needed.</li>
  <li>Click update and Save Settings both</li>
  <li>Goto to corresponding saved content eg: article</li>
  <li>You can see the read_only Ace Formatter appearing</li>
  
  <li><h3>Filter</h3></li>
  <li><h4>Embed code snippets in the body of your nodes or blocks</h4></li>
  <li>Add the syntax highlighting filter to any of your text formats. The module will now convert all content inside an &lt;ace&gt; tag to display the code using the selected options.</li>
  <li>You can override the default options by adding attributes to the &lt;ace&gt; tag, for example:</li>

  <li>&lt;ace&gt; theme="twilight" height="200px" font-size="12pt" print-margin="1">SOME CODE&lt;/ace&gt;

</li>
</ul>
</div>
