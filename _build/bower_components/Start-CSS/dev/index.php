<!doctype html>
<html class="no-js" lang="en-gb">
<head>
    <meta charset="utf-8">
    <title>Start-CSS Test Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--
        IE 9+, FF 8+, Opera 12, Chrome 29+, Android ~4.4+
        Chrome 29+, Opera 16+, Safari 6.1+, iOS 7+, Android ~4.4+
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,900" media="
        only screen and (min-resolution: 0.1dpcm),
        only screen and (-webkit-min-device-pixel-ratio:0) and (min-color-index:0)
    ">-->
    <link rel="stylesheet" href="css/start.css" media="
        only screen and (min-resolution: 0.1dpcm),
        only screen and (-webkit-min-device-pixel-ratio:0) and (min-color-index:0)
    ">

    <style>
        <?php echo file_get_contents('_test-page.css'); ?>
    </style>

</head>
<body role="document" class="tb-baseline  tb-outlines">

    <main id="main">
		<header>
			<h1>Start CSS Test Page</h1>
		</header>

        <p><a href="#">Test active link</a></p>
        <p><a href="#bottom">Skip to bottom</a></p>
        <p><a href="#tmp-lists">Skip to lists (temp)</a></p>
        <!--
        <h2>Notes</h2>
        <p>
            <strong>Sizing issues:</strong><br>
            Borders normally should be the same size regardless of font size.<br>
            Vertical Rhythm (VR) preserved by using either padding or margin tweaks to offset border- Border Compensation Tweaks (BCT).<br>
            VR is calculated by REMs so adjustment to <code>html</code> font-size should adjust whole VR.<br>
            However, doing this DOES NOT adjust the BCT.<br>
            So, perhaps have to consider changing all BCT values to <code>calc()</code> so that <code>html</code>  font-size adjustments (e.g. in Media Queries) will also adjust BCT.<br>
            Although, it's possible to make font-size changes on the <code>body</code>  font-size, so this may not be necessary.
        </p>

       <!-- <p>
            Double bottom space fix needs thought in how it relates to borders.
            The border/padding combination works fine, but the bottom margin of the inner elements will be a full spacing-unit, not adjusted for border-width.
            This means the combined margin is 1 full spacing unit and this negates the BCT.
            Maybe will have to make BCT margin-based and not padding based after all?
        </p>-->

        <h2>Forms</h2>


        <form>
            <fieldset>
                <p>Some inputs would be here, like this:</p>
                <p>Here's a <button>Button</button></p>
                <p>Here's a <button>Button with<br>a break</button></p>
                <p><input type="button" value="input type[button]"></p>
                <p><input type="reset" value="input type[reset]"></p>
                <p><input type="submit" value="input type[submit]"></p>
            </fieldset>
            <fieldset>
                <legend>A legend</legend>
                <p>
                    <label for="input1-1">Enter some text:</label> <input type="text" id="input1-1"> <button>Button</button>
                </p>
				<p>
                    <label for="input1a-1">Without <code>type</code> attribute:</label> <input type="text" id="input1a-1"> <button>Button</button>
                </p>
                <p>
                    <label for="input1-2">Choose a file:</label> <input type="file" id="input1-2"> <button>Button</button>
                </p>

                <p>
                    <label for="input1-3">Select unit type:</label>
                    <select id="input1-3">
                        <option value="1">Miner Long Name Jones Bones</option>
                        <option value="2">Puffer</option>
                        <option value="3">Snipey</option>
                        <option value="4">Max</option>
                        <option value="5">Firebot</option>
                        <option value="6">Roger</option>
                        <option value="7">Dodger</option>
                        <option value="8">Codger</option>
                        <option value="9">Bodger</option>
                        <option value="10">Splodger</option>
                        <option value="11">Zodger</option>
                        <option value="12">Modger</option>
                    </select> <button>Button</button>
                </p>

                <p>
                    Multi-select: (note Mac Safari treats <code>size</code> attributes less than 4 as 4)
                </p>

                <p>
                    <label for="input1-3a">Select unit types (<code>size="2"</code>):</label>
                    <select id="input1-3a" multiple size="2">
                        <option value="1">Miner Long Name Jones Bones</option>
                        <option value="2">Puffer</option>
                        <option value="3">Snipey</option>
                        <option value="4">Max</option>
                        <option value="5">Firebot</option>
                        <option value="6">Roger</option>
                        <option value="7">Dodger</option>
                        <option value="8">Codger</option>
                        <option value="9">Bodger</option>
                        <option value="10">Splodger</option>
                        <option value="11">Zodger</option>
                        <option value="12">Modger</option>
                    </select> <button>Button</button>
                </p>

                <p>
                    <label for="input1-3b">Select unit types (<code>size="3"</code>):</label>
                    <select id="input1-3b" multiple size="3">
                        <option value="1">Miner Long Name Jones Bones</option>
                        <option value="2">Puffer</option>
                        <option value="3">Snipey</option>
                        <option value="4">Max</option>
                        <option value="5">Firebot</option>
                        <option value="6">Roger</option>
                        <option value="7">Dodger</option>
                        <option value="8">Codger</option>
                        <option value="9">Bodger</option>
                        <option value="10">Splodger</option>
                        <option value="11">Zodger</option>
                        <option value="12">Modger</option>
                    </select> <button>Button</button>
                </p>
                <p>
                    <label for="input1-3c">Select unit types (<code>size="4"</code>):</label>
                    <select id="input1-3c" multiple size="4">
                        <option value="1">Miner Long Name Jones Bones</option>
                        <option value="2">Puffer</option>
                        <option value="3">Snipey</option>
                        <option value="4">Max</option>
                        <option value="5">Firebot</option>
                        <option value="6">Roger</option>
                        <option value="7">Dodger</option>
                        <option value="8">Codger</option>
                        <option value="9">Bodger</option>
                        <option value="10">Splodger</option>
                        <option value="11">Zodger</option>
                        <option value="12">Modger</option>
                    </select> <button>Button</button>
                </p>

                <p>
                    <label for="input1-3d">Select unit types (<code>size="5"</code>):</label>
                    <select id="input1-3d" multiple size="5">
                        <option value="1">Miner Long Name Jones Bones</option>
                        <option value="2">Puffer</option>
                        <option value="3">Snipey</option>
                        <option value="4">Max</option>
                        <option value="5">Firebot</option>
                        <option value="6">Roger</option>
                        <option value="7">Dodger</option>
                        <option value="8">Codger</option>
                        <option value="9">Bodger</option>
                        <option value="10">Splodger</option>
                        <option value="11">Zodger</option>
                        <option value="12">Modger</option>
                    </select> <button>Button</button>
                </p>

                <p>
                    <label for="input1-3e">Select unit types (<code>size="6"</code>):</label>
                    <select id="input1-3e" multiple size="6">
                        <option value="1">Miner Long Name Jones Bones</option>
                        <option value="2">Puffer</option>
                        <option value="3">Snipey</option>
                        <option value="4">Max</option>
                        <option value="5">Firebot</option>
                        <option value="6">Roger</option>
                        <option value="7">Dodger</option>
                        <option value="8">Codger</option>
                        <option value="9">Bodger</option>
                        <option value="10">Splodger</option>
                        <option value="11">Zodger</option>
                        <option value="12">Modger</option>
                    </select> <button>Button</button>
                </p>

                <p>
                    <label for="input1-3f">Select unit types (<code>size="7"</code>):</label>
                    <select id="input1-3f" multiple size="7">
                        <option value="1">Miner Long Name Jones Bones</option>
                        <option value="2">Puffer</option>
                        <option value="3">Snipey</option>
                        <option value="4">Max</option>
                        <option value="5">Firebot</option>
                        <option value="6">Roger</option>
                        <option value="7">Dodger</option>
                        <option value="8">Codger</option>
                        <option value="9">Bodger</option>
                        <option value="10">Splodger</option>
                        <option value="11">Zodger</option>
                        <option value="12">Modger</option>
                    </select> <button>Button</button>
                </p>

                <p>
                    <label for="input1-3g">Select unit types (<code>size="8"</code>):</label>
                    <select id="input1-3g" multiple size="8">
                        <option value="1">Miner Long Name Jones Bones</option>
                        <option value="2">Puffer</option>
                        <option value="3">Snipey</option>
                        <option value="4">Max</option>
                        <option value="5">Firebot</option>
                        <option value="6">Roger</option>
                        <option value="7">Dodger</option>
                        <option value="8">Codger</option>
                        <option value="9">Bodger</option>
                        <option value="10">Splodger</option>
                        <option value="11">Zodger</option>
                        <option value="12">Modger</option>
                    </select> <button>Button</button>
                </p>

                <p>
                    <label for="input1-3h">Select unit types (<code>size="9"</code>):</label>
                    <select id="input1-3h" multiple size="9">
                        <option value="1">Miner Long Name Jones Bones</option>
                        <option value="2">Puffer</option>
                        <option value="3">Snipey</option>
                        <option value="4">Max</option>
                        <option value="5">Firebot</option>
                        <option value="6">Roger</option>
                        <option value="7">Dodger</option>
                        <option value="8">Codger</option>
                        <option value="9">Bodger</option>
                        <option value="10">Splodger</option>
                        <option value="11">Zodger</option>
                        <option value="12">Modger</option>
                    </select> <button>Button</button>
                </p>

                <p>
                    <label for="input1-3i">Select unit types (<code>size="10"</code>):</label>
                    <select id="input1-3i" multiple size="10">
                        <option value="1">Miner Long Name Jones Bones</option>
                        <option value="2">Puffer</option>
                        <option value="3">Snipey</option>
                        <option value="4">Max</option>
                        <option value="5">Firebot</option>
                        <option value="6">Roger</option>
                        <option value="7">Dodger</option>
                        <option value="8">Codger</option>
                        <option value="9">Bodger</option>
                        <option value="10">Splodger</option>
                        <option value="11">Zodger</option>
                        <option value="12">Modger</option>
                    </select> <button>Button</button>
                </p>

                <p>
                    <input type="checkbox" id="input1-4"> <label for="input1-4">I agree to the terms</label>
                </p>

                <fieldset>
                    <p>
                        <input type="radio" id="input1-5a" name="input1-5"> <label for="input1-5a">Radio 1</label> <input type="radio" id="input1-5b" name="input1-5"> <label for="input1-5b">Radio 2</label>
                    </p>
                </fieldset>

                <p>
                    <label for="input1-5">Enter some text:</label> <textarea id="input1-5">Some test text
spanning multiple
lines.</textarea>
                </p>
            </fieldset>
            <fieldset>
                <legend>A legend</legend>
                <p>
                    <label for="input1-6"><code>&lt;color&gt;</code> input:</label> <input type="color" id="input1-6"> <button>Button</button>
                </p>
                <p>
                    <label for="input1-7"><code>&lt;date&gt;</code> input:</label> <input type="date" id="input1-7"> <button>Button</button>
                </p>
                <p>
                    <label for="input1-8"><code>&lt;datetime&gt;</code> input:</label> <input type="datetime" id="input1-8"> <button>Button</button>
                </p>
                <p>
                    <label for="input1-9"><code>&lt;datetime-local&gt;</code> input:</label> <input type="datetime-local" id="input1-9"> <button>Button</button>
                </p><p>
                    <label for="input1-10"><code>&lt;month&gt;</code> input:</label> <input type="month" id="input1-10"> <button>Button</button>
                </p>
                <p>
                    <label for="input1-11"><code>&lt;number&gt;</code> input:</label> <input type="number" id="input1-11"> <button>Button</button>
                </p>
                <p>
                    <label for="input1-12"><code>&lt;password&gt;</code> input:</label> <input type="password" id="input1-12"> <button>Button</button>
                </p>
                <p>
                    <label for="input1-13"><code>&lt;range&gt;</code> input:</label> <input type="range" id="input1-13"> <button>Button</button>
                </p>
                <p>
                    <label for="input1-14"><code>&lt;search&gt;</code> input:</label> <input type="search" id="input1-14"> <button>Button</button>
                </p>
                <p>
                    <label for="input1-15"><code>&lt;tel&gt;</code> input:</label> <input type="tel" id="input1-15"> <button>Button</button>
                </p>
                <p>
                    <label for="input1-16"><code>&lt;time&gt;</code> input:</label> <input type="time" id="input1-16"> <button>Button</button>
                </p>
                <p>
                    <label for="input1-17"><code>&lt;url&gt;</code> input:</label> <input type="url" id="input1-17"> <button>Button</button>
                </p>
                <p>
                    <label for="input1-18"><code>&lt;week&gt;</code> input:</label> <input type="week" id="input1-18"> <button>Button</button>
                </p>
                <p>
                    Progress: <progress></progress>
                </p>
            </fieldset>
        </form>
        <form oninput="result.value=parseInt(a.value)+parseInt(b.value)">
			<p>
				Output: <input type="range" name="b" value="50" /> +
				<input type="number" name="a" value="10" /> =
				<output name="result">60</output>
			</p>
        </form>
        <p>
            <code>&lt;meter&gt;</code> examples:
        </p>
        <p>
            Heat the oven to <meter min="200" max="500" value="350">350 degrees</meter>.
        </p>
        <p>
            He got a <meter low="69" high="80" max="100" value="84">B</meter> on the exam.
        </p>

        <hr>
        <h2>Heading 2</h2>
        <p>Pellentesque habitant morbi tristique <a href="#">some inline link</a> senectus et netus et <a href="#" rel="external">some inline external link</a> malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

        <h3>Heading 3</h3>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

        <h4>Heading 4</h4>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

        <h5>Heading 5</h5>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

        <h6>Heading 6</h6>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

        <hr>
        <h2>Heading 2<br>Simulate line-wrap</h2>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>

        <h3>Heading 3<br>Simulate line-wrap</h3>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>

        <h4>Heading 4<br>Simulate line-wrap</h4>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>

        <h5>Heading 5<br>Simulate line-wrap</h5>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>

        <h6>Heading 6<br>Simulate line-wrap</h6>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>

        <h2>Blockquotes</h2>

        <blockquote>
             The people recognize themselves in their commodities; they find their
             soul in their automobile, hi-fi set, split-level home, kitchen equipment.
             — <cite><a href="https://en.wikipedia.org/wiki/Herbert_Marcuse">Herbert Marcuse</a></cite>
        </blockquote>

        <blockquote>
            <p>I contend that we are both atheists. I just believe in one fewer
            god than you do. When you understand why you dismiss all the other
            possible gods, you will understand why I dismiss yours.</p>
            <footer>— <cite>Stephen Roberts</cite></footer>
        </blockquote>

        <h2>Lists</h2>

        <h3><code>ol</code></h3>
        <p>I have lived in the following countries (given in the order of when I first lived there):</p>
        <ol>
            <li>Switzerland</li>
            <li>United Kingdom</li>
            <li>United States</li>
            <li>Norway</li>
        </ol>

        <p id="tmp-lists">Same list with various type attributes (the floated image tests the fix for <a href="https://paulbakaus.com/tutorials/css/block-formatting-contexts-and-lists">list number/bullet position problem</a>).</p>

		<img src="media/poster.jpg" style="float: left; width:40%;">

        <ol type="1">
            <li>Switzerland</li>
            <li>United Kingdom</li>
            <li>United States</li>
            <li>Norway</li>
        </ol>

        <ol type="a">
            <li>Switzerland</li>
            <li>United Kingdom</li>
            <li>United States</li>
            <li>Norway</li>
        </ol>

        <ol type="A">
            <li>Switzerland</li>
            <li>United Kingdom</li>
            <li>United States</li>
            <li>Norway</li>
        </ol>

        <ol type="i">
            <li>Switzerland</li>
            <li>United Kingdom</li>
            <li>United States</li>
            <li>Norway</li>
        </ol>

        <ol type="I">
            <li>Switzerland</li>
            <li>United Kingdom</li>
            <li>United States</li>
            <li>Norway</li>
        </ol>

        <p>Same list reversed</p>

        <ol reversed>
            <li>Switzerland</li>
            <li>United Kingdom</li>
            <li>United States</li>
            <li>Norway</li>
        </ol>


        <p>Same list start at 5</p>

        <ol start="5">
            <li>Switzerland</li>
            <li>United Kingdom</li>
            <li>United States</li>
            <li>Norway</li>
        </ol>

        <p>Start at 5 AND reversed</p>

        <ol start="5" reversed>
            <li>Switzerland</li>
            <li>United Kingdom</li>
            <li>United States</li>
            <li>Norway</li>
        </ol>


        <p>Nested:</p>
        <ol>
            <li>Switzerland</li>
            <li>
                United Kingdom
                <ol>
                    <li>Manchester</li>
                    <li>Leeds</li>
                    <li>
                        London
                        <ol>
                            <li>Inner</li>
                            <li>Outer</li>
                            <li>Greater</li>
                        </ol>
                    </li>
                </ol>
            </li>
            <li>United States</li>
            <li>Norway</li>
        </ol>

        <h3><code>ul</code></h3>
        <p>I have lived in the following countries:</p>
        <ul>
            <li>Norway</li>
            <li>Switzerland</li>
            <li>
                United Kingdom
                <ul>
                    <li>Manchester</li>
                    <li>Leeds</li>
                    <li>
                        London
                        <ul>
                            <li>Inner</li>
                            <li>Outer</li>
                            <li>Greater</li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>United States</li>
        </ul>

        <h3><code>dl</code></h3>

        <dl>
            <dt>Last modified time</dt>
            <dd>2004-12-23T23:33Z</dd>
            <dt>Recommended update interval</dt>
            <dd>60s</dd>
            <dt>Authors</dt>
            <dt>Editors</dt>
            <dd>Robert Rothman</dd>
            <dd>Daniel Jackson</dd>
        </dl>

        <div>
        <h2>Text-level elements</h2>
        <p>
            <a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-a-element" rel="external">[a]</a>: <a href="#">With href</a>. <a>Without href</a>. <a href="https://www.w3.org/TR/html5/text-level-semantics.html#text-level-semantics" rel="external">External link</a>. <a href="https://html.spec.whatwg.org/multipage/semantics.html#linkTypes" rel="external"><code>rel="external"</code> appears on WHATWG</a>.
        </p>
        <p>
            On a related note, very long words like "rindfleischetikettierungsüberwachungsaufgabenübertragungsgesetz" (see <a href="https://en.wikipedia.org/wiki/Rinderkennzeichnungs-_und_Rindfleischetikettierungs%C3%BCberwachungsaufgaben%C3%BCbertragungsgesetz" rel="external">rindfleischetikettierungsüberwachungsaufgabenübertragungsgesetz</a>) need to be catered for with regards to word-wrapping.
        </p>
        <p>
            <a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-em-element" rel="external">[em]</a> and <a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-strong-element" rel="external">[strong]</a>: <em>Stress emphasis</em> and <strong>strong importance, seriousness, or urgency</strong>.
        </p>
        <p>
            <a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-small-element" rel="external">[small]</a>: <small>side comments such as small print</small>.
        </p>
        <p>
            <a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-s-element" rel="external">[s]</a>: <s>Contents that are no longer accurate or no longer relevant</s>.
        </p>
        <p>
            <a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-cite-element" rel="external">[cite]</a>: A reference to a creative work. It must include the title of the work or the name of the author(person, people or organization) or an URL reference, or a reference in abbreviated form as per the conventions used for the addition of citation metadata. E.g. In the words of <cite>Charles Bukowski</cite> -  <q>An intellectual says a simple thing in a hard way. An artist says a hard thing in a simple way.</q>.
        </p>
        <p>
            <a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-q-element" rel="external">[q]</a>: content quoted from another source. E.g. The man said <q>Things that are impossible just take longer</q>. I disagreed with him.
        </p>
        <p>
            <a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-abbr-element" rel="external">[abbr]</a>: An abbreviation or acronym, optionally with its expansion. The title attribute may be used to provide an expansion of the abbreviation. The attribute, if specified, must contain an expansion of the abbreviation, and nothing else. E.g. The <abbr title="Web Hypertext Application Technology Working Group">WHATWG</abbr> started working on HTML5 in 2004.
        </p>
        <p>
            <a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-dfn-element" rel="external">[dfn]</a>: Represents the defining instance of a term. E.g. The <dfn><abbr title="Garage Door Opener">GDO</abbr></dfn> is a device that allows off-world teams to open the iris. --- later... --- Teal'c activated his <abbr title="Garage Door Opener">GDO</abbr> and so Hammond ordered the iris to be opened.
        </p>
        <p>
            <a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-time-element" rel="external">[time]</a>: Rrepresents its contents, along with a machine-readable form of those contents in the datetime attribute. The kind of content is limited to various kinds of dates, times, time-zone offsets, and durations. E.g. <time class="dtstart" datetime="2005-10-05">October 5</time>.
        </p>
        <p>
            <a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-code-element" rel="external">[code]</a>: Represents a fragment of computer code. E.g. The <code>code</code> element represents a fragment of computer code.
        </p>
        <p>
            <a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-var-element" rel="external">[var]</a>: Represents a variable. E.g. If there are <var>n</var> pipes leading to the ice cream factory...
        </p>
        <p>
            <a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-samp-element" rel="external">[samp-]</a>: Represents a sample or quoted output from another program or computing system. E.g. The computer said <samp>Too much cheese in tray two</samp> but I didn't know what that meant.
        </p>
        <p>
            <a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-kbd-element" rel="external">[kbd]</a>: Represents user input (typically keyboard input, although it may also be used to represent other input, such as voice commands). E.g. To make George eat an apple, press <kbd><kbd>Shift</kbd>+<kbd>F3</kbd></kbd>.
        </p>
        <p>
            <a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-sup-element" rel="external">[sup and sup]</a>: Represents a superscript and the sub element represents a subscript. The most beautiful women are <span lang="fr"><abbr>M<sup>lle</sup></abbr> Gwendoline</span> and <span lang="fr"><abbr>M<sup>me</sup></abbr> Denise</span>. The coordinate of the <var>i</var>th point is (<var>x<sub><var>i</var></sub></var>, <var>y<sub><var>i</var></sub></var>). For example, the 10th point has coordinate (<var>x<sub>10</sub></var>, <var>y<sub>10</sub></var>).
        </p>
        <p>
            <a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-i-element" rel="external">[i]</a>: Represents a span of text in an alternate voice or mood, or otherwise offset from the normal prose in a manner indicating a different quality of text, such as a taxonomic designation, a technical term, an idiomatic phrase from another language, transliteration, a thought, or a ship name in Western texts. E.g. The <i class="taxonomy">Felis silvestris catus</i> is cute. The term <i>prose content</i> is defined above. There is a certain <i lang="fr">je ne sais quoi</i> in the air.
        </p>
        <p>
            <a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-b-element" rel="external">[b]</a>: Represents a span of text to which attention is being drawn for utilitarian purposes without conveying any extra importance and with no implication of an alternate voice or mood, such as key words in a document abstract, product names in a review, actionable words in interactive text-driven software, or an article lede. E.g. The <b>frobonitor</b> and <b>barbinator</b> components are fried. <b>Emboldened text can be nested 2 levels deep and <code>bolder</code> should be applied to the inner level, like <b>this</b>.</b>
        </p>
        <p>
            <a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-u-element" rel="external">[u]</a>: Represents a span of text with an unarticulated, though explicitly rendered, non-textual annotation, such as labeling the text as being a proper name in Chinese text (a Chinese proper name mark), or labeling the text as being misspelt. E.g. The <u>see</u> is full of fish.
        </p>
        <p>
            <a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-mark-element" rel="external">[mark]</a>: Represents a run of text in one document marked or highlighted for reference purposes, due to its relevance in another context. E.g. I also have some <mark>kitten</mark>s who are visiting me these days. They're really cute. I think they like my garden! Maybe I should adopt a <mark>kitten</mark>.
        </p>


        </div>

        <h2>Text-level Combinations</h2>
        <p>
            Sometimes links have other elements nested within them. For example a link to <a href="https://www.w3.org/TR/css-fonts-3/#font-family-prop">the <code>font-family</code> spec</a> containes a nested <code>&lt;code&gt;</code> element.
            There's also the case where the <code>&lt;code&gt;</code> elements is the <em>only</em> child of a link, like this: <a href="https://www.w3.org/TR/css-fonts-3/#propdef-font-style"><code>font-style</code></a>.
            If any element that can be nested within another is too-heavily styled, complicatatons can occur.
        </p>
        <p>
            Another possibility is a <a href="#">link with <mark>mark</mark> inside it</a>.
        </p>

        <p>Nest <b>bold with <i>italics</i> to test the</b> font properly.</p>

        <p>And again with nested <b>bold with <b><i>bolder italics</i></b> to test the</b> font some more.</p>


        <h2>Other</h2>

            <pre><code>Small - no scrolling</code></pre>

        <p>Random text</p>

        <figure>
            <figcaption>HTML</figcaption>
                <pre><code>&lt;!-- Chrome 29+, Opera 16+, Safari 6.1+, iOS 7+, Android ~4.4+, IE10+ (including Edge) --&gt;
&lt;link rel="stylesheet" href="css/your-stylesheet.css"
  media="only screen and (-webkit-min-device-pixel-ratio:0) and (min-color-index:0), (-ms-high-contrast: none)"&gt;
&lt;!-- FF29+ --&gt;
&lt;link rel="stylesheet" href="css/your-stylesheet.css"
  media="only all and (min--moz-device-pixel-ratio:0) and (min-resolution: 3e1dpcm)"&gt;
</code></pre>
        </figure>

        <hr>

        <details>
            <summary>Show/Hide me</summary>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
        </details>

        <hr>

        <h2>Media</h2>

        <!--
        Improve/expand upon the SVG and link to dedicated page that contains more examples and
        explanation.
        -->

        <div class="box">
            <object type="image/svg+xml" data="https://lab.gridlight-design.co.uk/fallback/img/fallback-logo.svg" height="144" class="svg__image">
                <p>Object failed to load.</p>
            </object>
        </div>

        <p>
            <a href="#">
                <img src="https://lab.gridlight-design.co.uk/images/blogish/pexels-photo-172256.jpg" alt="" width="300">
            </a>
        </p>

        <figure>
           <img src="media/poster.jpg" width="640" height="360" alt="Big Buck Bunny">
           <figcaption>
                Image
            </figcaption>
        </figure>

        <p>Linked image:</p>
        <p><a href="#"><img src="media/poster.jpg" width="640" height="360" alt="Big Buck Bunny"></a></p>


        <figure>
            <!-- first try HTML5 playback: if serving as XML, expand `controls` to `controls="controls"` and autoplay likewise       -->
            <!-- warning: playback does not work on iPad/iPhone if you include the poster attribute! fixed in iOS4                   -->
            <video width="640" height="360" controls>
                <!-- MP4 must be first for iPad! -->
                <source src="media/big_buck_bunny.mp4" type="video/mp4"><!-- Safari / iOS, IE9 -->
                <source src="media/big_buck_bunny.webm" type="video/webm"><!-- Chrome10+, Ffx4+, Opera10.6+ -->
                <source src="media/big_buck_bunny.ogv" type="video/ogg"><!-- Firefox3.6+ / Opera 10.5+ -->
                <!-- fallback to Flash: -->
                <object width="640" height="360" type="application/x-shockwave-flash" data="media/player.swf">
                    <!-- Firefox uses the `data` attribute above, IE/Safari uses the param below -->
                    <param name="movie" value="player.swf">
                    <param name="flashvars" value="autostart=true&amp;controlbar=over&amp;image=poster.jpg&amp;file=media/big_buck_bunny.mp4">
                    <!-- fallback image -->
                    <img src="media/poster.jpg" width="640" height="360" alt="Big Buck Bunny"
                         title="No video playback capabilities, please download the video below">
                </object>
            </video>
            <!-- you *must* offer a download link as they may be able to play the file locally. customise this bit all you want -->
            <figcaption>
                <strong>Download Video:</strong> Closed Format: <a href="media/big_buck_bunny.mp4">"MP4"</a> Open Format: <a href="media/big_buck_bunny.ogv">"OGG"</a> / <a href="media/big_buck_bunny.webm">"WebM"</a>
            </figcaption>
        </figure>

        <table id="Books">
            <caption id="Cap1">Books I May or May Not Have Read</caption>
            <thead>
                <tr>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Year</th>
                    <th>ISBN-13</th>
                    <th>ISBN-10</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Miguel De Cervantes</td>
                    <td>The Ingenious Gentleman Don Quixote of La Mancha</td>
                    <td>1605</td>
                    <td>9783125798502</td>
                    <td>3125798507</td>
                    </tr>
                <tr>
                <td>Mary Shelley</td>
                    <td>Frankenstein; or, The Modern Prometheus</td>
                    <td>1818</td>
                    <td>9781530278442</td>
                    <td>1530278449</td>
                </tr>
                <tr>
                    <td>Herman Melville</td>
                    <td>Moby-Dick; or, The Whale</td>
                    <td>1851</td>
                    <td>9781530697908</td>
                    <td>1530697905</td>
                </tr>
                <tr>
                    <td>Emma Dorothy Eliza Nevitte Southworth</td>
                    <td>The Hidden Hand</td>
                    <td>1888</td>
                    <td>9780813512969</td>
                    <td>0813512964</td>
                </tr>
                <tr>
                    <td>F. Scott Fitzgerald</td>
                    <td>The Great Gatsby</td>
                    <td>1925</td>
                    <td>9780743273565</td>
                    <td>0743273567</td>
                </tr>
                <tr>
                    <td>George Orwell</td>
                    <td>Nineteen Eighty-Four</td>
                    <td>1948</td>
                    <td>9780451524935</td>
                    <td>0451524934</td>
                </tr>
            </tbody>
        </table>

        <table id="browser_info">
            <caption>Browser info</caption>
            <thead>
                <tr><th>Name</th><th>Value</th></tr>
            </thead>
            <tbody>
                <tr><td colspan="2">No Javascript - unable to detect anything!</td></tr>
            </tbody>
        </table>

        <p>
            Some more text.
        </p>

        <footer>
            <p>Contact information for this page:</p>
            <address>
                someone@somewhere.com
            </address>
        </footer>
    </main>

    <div id="bottom"></div>

    <script>
        <?php echo file_get_contents('_test-page.js'); ?>
    </script>
</body>
</html>