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

    if (! $valid) exit('Invalid values.');

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

<h3>Firefox</h3>

<ol>
    <li>Click the "+" icon in the search field</li>
    <li>Click "Add Disconnect Search (${ses}, ${location})"</li>
    <li>Right-click the Disconnect Search icon</li>
    <li>Click "Set As Default Search Engine"</li>
</ol>

<h3>Chrome, Chromium</h3>

<ol>
    <li>In the top right, click the Chrome menu</li>
    <li>Select "Settings"</li>
    <li>Go to the "Search" section</li>
    <li>Click "Manage search engines"</li>
    <li>Fill out the fields to set up the search engine
        <ul>
            <li>Disconnect Search (${ses}, ${location})</li>
            <li>disconnect.me</li>
            <li>https://search.disconnect.me/searchTerms/search?ses=${ses}&amp;location=${location}&amp;query=%s</li>
        </ul>
    </li>
    <li>Click "Done"</li>
    <li>Click "Manage search engines" again</li>
    <li>Hover over "Disconnect Search (${ses}, ${location})"</li>
    <li>Click "Make Default"</li>
</ol>
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
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" media="screen" href="css/main.css" />

    <title>Disconnect OpenSearch</title>

    ${link}

    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
<div class="wrapper">
<h1><a href="/"><strong>Disconnect</strong> OpenSearch</a></h1>

${content}

<h2>About</h2>

<p>This application provides custom <a href="http://www.opensearch.org/Specifications/OpenSearch/1.1#OpenSearch_description_document">OpenSearch description documents</a> for <a href="https://search.disconnect.me/searchTerms/">Disconnect Search</a>.</p>

<p>This is a Free software, view <a href="https://github.com/alct/disconnect-opensearch">source code</a>.</p>
</div>
</body>
</html>
EOT;

}
