# AceEditor-Drupal8
<h2>Project Description</h2>
<p>This project port <a href="https://www.drupal.org/project/ace_editor">Ace Editor module for Drupal 7</a> to Drupal 8. Ace is a code editor written in JavaScript, allowing you to edit HTML, PHP and JavaScript (and more). in a very natural way. It provides syntax highlighting, proper indentation, keyboard shortcuts, auto-completion, code folding, find and replace (including regular expressions). Try out a demo of the editor here.</p>

<p>This module integrates the Ace editor into Drupal's node/block edit forms, for editing raw HTML/PHP/JavaScript etc. in a familiar way.</p>
<ul>
  <li> <h3>It supports:</h3>

  <li>node edit forms, including summary</li>
  <li>blocks and beans edit forms</li>
  <li>Panels pane editor</li>
  <li>It also provides a display formatter, along with a text filter and an API to embed and show code snippets in your content.</li>
<ul>
<div>

  <h3>Edit HTML and PHP in your nodes and blocks like a pro</h3>

  <h3>Display fields using syntax highlighting</h3>
  <p>Manage the display of any textarea fields attached to a node and select the "Code syntax highlighting" format. This outputs the content of the field as a ready-only editor with syntax highlighting in your node view using the selected options</p>

  <h3>Embed code snippets in the body of your nodes or blocks</h3>
  <p>Add the syntax highlighting filter to any of your text formats. The module will now convert all content inside an &lt;ace&gt; tag to display the code using the selected options.</p>

  <p>You can override the default options by adding attributes to the &lt;ace&gt; tag, for example:</p>

  &lt;ace theme="twilight" height="200px" font-size="12pt" print-margin="1"&gt;SOME CODE&lt;/ace&gt;

</div>
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
