<?php

$location_array = [
    'AR', 'AU', 'AT', 'BE', 'BEF', 'BR', 'CA', 'CAF', 'CL', 'CN', 'DK', 'FI',
    'FR', 'DE', 'HK', 'IN', 'ID', 'IT', 'JP', 'KR', 'MY', 'MX', 'NL', 'NZ',
    'NO', 'PH', 'PL', 'PT', 'RU', 'SA', 'ZA', 'ES', 'SE', 'CHG', 'CH', 'TW',
    'TR', 'UK', 'US', 'USE'
];

$ses_array = [ 'Bing', 'DuckDuckGo', 'Google', 'Yahoo' ];

if (in_array($_GET['ses'], $ses_array)
 && in_array($_GET['location'], $location_array)) {

    $ses = $_GET['ses'];
    $location = $_GET['location'];
    $valid = true;
}

if (isset($_GET['opensearch'])) {

    if (! $valid) {

        http_response_code(400);

        exit('Invalid values.');
    }

    header('Content-Type: application/xml');

    echo <<<EOT
<?xml version="1.0" encoding="utf-8" ?>
<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/">
    <ShortName>Disconnect Search (${ses}, ${location})</ShortName>
    <Description>Disconnect Search (${ses}, ${location})</Description>
    <Image width="16" height="16" type="image/x-icon">https://search.disconnect.me/static/V1MUXDySCwmKVr0iWNqRCJrpMOnAcepi6q2EpwljODO.ico</Image>
    <Url type="text/html" template="https://search.disconnect.me/searchTerms/search?ses=${ses}&amp;location=${location}&amp;query={searchTerms}" />
</OpenSearchDescription>
EOT;

} else {
    if ($valid) {

        $link = <<<EOT
<link rel="search" type="application/opensearchdescription+xml" title="Disconnect Search (${ses}, ${location})" href="?opensearch&ses=${ses}&location=${location}" />
EOT;

        $content = <<<EOT
<h2>Current configuration</h2>

<p>${ses}, ${location}.</p>

<h2>Add and set Disconnect Search as the default search engine</h2>

<div class="js-alert no-js">
    <h3>Please (temporarily) enable Javascript</h3>

    <p>Some browser vendors do not provide means to add custom search providers other than using a <a href="https://developer.mozilla.org/en-US/docs/Web/API/Window/sidebar/Adding_search_engines_from_Web_pages">specific Javascript API</a>.</p>

    <h3>However, if you use Firefox (desktop)…</h3>

    <p>The process is straightforward even without Javascript (Kudos Mozilla!):</p>

    <ol>
        <li>Click the "+" icon in the search field&nbsp;;</li>
        <li>Click "Add Disconnect Search (${ses}, ${location})"&nbsp;;</li>
        <li>Right-click the Disconnect Search icon&nbsp;;</li>
        <li>Click "Set As Default Search Engine".</li>
    </ol>
</div>

<ul class="nav">
    <li class="firefox active"><a href="#firefox">Firefox</a></li>
    <li class="firefox-android"><a href="#firefox-android">Firefox (Android)</a></li>
    <li class="chrome"><a href="#chrome">Chrome/ium</a></li>
    <li class="ie"><a href="#ie">Internet Explorer</a></li>
    <li class="others"><a href="#others">Others</a></li>
</ul>

<div class="instructions firefox active">
    <h3 id="firefox">Firefox</h3>

    <p>Clicking the "Add Disconnect Search" button below opens a pop-up window, check the "Make this the current search engine" checkbox and then, click "Add".</p>

    <p class="button">
        <input type="button" value="Add Disconnect Search" class="add-button" />
    </p>
</div>

<div class="instructions firefox-android">
    <h3 id="firefox-android">Firefox (Android)</h3>

    <p>Clicking the "Add Disconnect Search" button below opens a pop-up window, click "Add".</p>

    <ol>
        <li class="button"><input type="button" value="Add Disconnect Search" class="add-button" /></li>
        <li>In the top right, click the Firefox menu&nbsp;;</li>
        <li>Click "Settings"&nbsp;;</li>
        <li>Click "Customize"&nbsp;;</li>
        <li>Click "Search"&nbsp;;</li>
        <li>Click "Disconnect Search (${ses}, ${location})"&nbsp;;</li>
        <li>Click "Set as default".</li>
    </ol>
</div>

<div class="instructions chrome">
    <h3 id="chrome">Chrome/ium</h3>

    <p>Clicking the "Add Disconnect Search" button below opens a pop-up window, click "Add".</p>

    <ol>
        <li class="button"><input type="button" value="Add Disconnect Search" class="add-button" /></li>
        <li>Right-click the address bar&nbsp;;</li>
        <li>Click "Edit search engines…"&nbsp;;</li>
        <li>Hover over "Disconnect Search (${ses}, ${location})"&nbsp;;</li>
        <li>Click "Make Default"&nbsp;;</li>
        <li>Click "Done".</li>
    </ol>
</div>

<div class="instructions ie">
    <h3 id="ie">Internet Explorer</h3>

    <p>Clicking the "Add Disconnect Search" button below opens a pop-up window, check the "Make this my default search provider" checkbox and then, click "Ok".</p>

    <p class="button">
        <input type="button" value="Add Disconnect Search" class="add-button" />
    </p>
</div>

<div class="instructions others">
    <h3 id="others">Others</h3>

    <p>If your browser is not listed or not supported, one of the following methods might work for you.</p>

    <h4>AddSearchProvider API</h4>

    <p>Give the following button a click.</p>

    <p class="button">
        <input type="button" value="Add Disconnect Search" class="add-button" />
    </p>

    <h4>Autodiscovery</h4>

    <p>Your browser might automatically suggest to add the Disconnect Search provider upon visiting the page. Pay attention to the search bar (if there is any).</p>

    <h4>URL template</h4>

    <p>If your browser allows for manual editing of search engine providers, this is what the URL template looks like:</p>

    <pre><code>https://search.disconnect.me/searchTerms/search?ses=${ses}&amp;location=${location}&amp;query={searchTerms}</code></pre>

    <p>Note that <code>{searchTerms}</code> is just a placeholder, it might be something else, such as <code>%s</code>.</p>

    <h4>OpenSearch description document</h4>

    <p>If, by any chance, your browser allows for manual adding of OpenSearch description documents, here is the current one: <a href="?opensearch&ses=${ses}&location=${location}">Disconnect Search (${ses}, ${location})</a>.</p>

    <h4>Eventually…</h4>

    <p>If none of the above worked for you, it might be time to change for a <a href="https://mozilla.org/en-US/firefox/new/">modern and free (as in "freedom") web browser</a>.</p>
</div>

<script src="js/main.js"></script>
EOT;

    } else {

    $content = <<<EOT
<h2>Generator</h2>

<form action="" method="get">
<p>
    <label for="ses">Search Engine</label>
    <select name="ses" id="ses">
        <option value="Google">Google</option>
        <option value="Bing">Bing</option>
        <option value="Yahoo">Yahoo</option>
        <option value="DuckDuckGo">DuckDuckGo</option>
    </select>
</p>

<p>
    <label for="location">Location</label>
    <select name="location" id="location">
        <option value="AR">Argentina</option>
        <option value="AU">Australia</option>
        <option value="AT">Austria</option>
        <option value="BE">Belgium (NL)</option>
        <option value="BEF">Belgium (FR)</option>
        <option value="BR">Brazil</option>
        <option value="CA">Canada (EN)</option>
        <option value="CAF">Canada (FR)</option>
        <option value="CL">Chile</option>
        <option value="CN">China</option>
        <option value="DK">Denmark</option>
        <option value="FI">Finland</option>
        <option value="FR">France</option>
        <option value="DE">Germany</option>
        <option value="HK">Hong Kong</option>
        <option value="IN">India</option>
        <option value="ID">Indonesia</option>
        <option value="IT">Italy</option>
        <option value="JP">Japan</option>
        <option value="KR">Korea</option>
        <option value="MY">Malaysia</option>
        <option value="MX">Mexico</option>
        <option value="NL">Netherlands</option>
        <option value="NZ">New Zealand</option>
        <option value="NO">Norway</option>
        <option value="PH">Philippines</option>
        <option value="PL">Poland</option>
        <option value="PT">Portugal</option>
        <option value="RU">Russia</option>
        <option value="SA">Saudi Arabia</option>
        <option value="ZA">South Africa</option>
        <option value="ES">Spain</option>
        <option value="SE">Sweden</option>
        <option value="CHG">Switzerland (DE)</option>
        <option value="CH">Switzerland (FR)</option>
        <option value="TW">Taiwan</option>
        <option value="TR">Turkey</option>
        <option value="UK">United Kingdom</option>
        <option value="US">United States (EN)</option>
        <option value="USE">United States (ES)</option>
    </select>
</p>

<p class="button"><input type="submit" value="Generate" /></p>
</form>
EOT;

    }

echo <<<EOT
<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" media="screen" href="css/main.css" />

    <title>Disconnect OpenSearch</title>

    ${link}

    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
<div class="wrapper">
<h1><a href="./"><strong>Disconnect</strong> OpenSearch</a></h1>

${content}

<h2>About</h2>

<p>This application provides custom <a href="http://www.opensearch.org/Specifications/OpenSearch/1.1#OpenSearch_description_document">OpenSearch description documents</a> for <a href="https://search.disconnect.me/searchTerms/">Disconnect Search</a>.</p>

<p>This is a Free software, view <a href="https://github.com/alct/disconnect-opensearch">source code</a>.</p>
</div>
</body>
</html>
EOT;

}
