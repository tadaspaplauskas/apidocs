<html>
    <head>
        <meta charset="utf-8">
        <title>ApiDocs - {{ $lastModified }}</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <style>
            @import url(http://fonts.googleapis.com/css?family=Roboto:400,700|Inconsolata|Raleway:200);
            body
            {
                background: white;
                color: black;
                font-family: 'Roboto',Helvetica,sans-serif;
                font-size: 14px;
                line-height: 1.42;
            }
            header
            {
                border-bottom: 1px solid #ededed;
                margin-bottom: 12px;
            }
            h1,h2,h3,h4,h5
            {
                color: black;
                margin: 12px 0;
            }
            h1
            {
                font-family: 'Raleway',Helvetica,sans-serif;
                font-size: 36px;
                font-weight: 500;
            }
            h2
            {
                font-family: 'Raleway',Helvetica,sans-serif;
                font-size: 30px;
                font-weight: 500;
            }
            h3
            {
                font-size: 100%;
                text-transform: uppercase;
            }
            h5
            {
                font-size: 100%;
                font-weight: normal;
            }
            p
            {
                margin: 0 0 10px;
            }
            a
            {
                color: #18bc9c;
                text-decoration: none;
            }
            li p
            {
                margin: 0;
            }
            blockquote
            {
                border-left: 5px solid #e8e8e8;
                color: rgba(0,0,0,0.5);
                font-size: 15.5px;
                margin: 12px 0;
                padding: 10px 20px;
            }
            blockquote p:last-child
            {
                margin-bottom: 0;
            }
            code
            {
                background-color: #f5f5f5;
                border: 1px solid #cfcfcf;
                border-radius: 3px;
                color: #444;
                font-family: 'Inconsolata',monospace;
                padding: 1px 4px;
            }
            ul,ol
            {
                padding-left: 2em;
            }
            table
            {
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 12px;
            }

            nav
            {
                bottom: 0;
                overflow-y: auto;
                position: fixed;
                top: 24px;
            }
            nav .resource-group
            {
                padding: 0;
            }
            nav .resource-group .heading
            {
                position: relative;
            }
            nav .resource-group .heading a
            {
                border-left: 2px solid transparent;
                color: black;
                display: block;
                margin: 0;
                opacity: .7;
            }
            nav ul
            {
                list-style-type: none;
                padding-left: 0;
            }
            nav ul a
            {
                border-left: 2px solid transparent;
                border-top: 1px solid #ededed;
                color: rgba(0,0,0,0.7);
                display: block;
                font-size: 13px;
                overflow: hidden;
                padding: 8px 12px;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
            .pull-left
            {
                float: left;
            }
            .pull-right
            {
                float: right;
            }
            .badge
            {
                background-color: #ededed;
                border-radius: 10px;
                color: #000;
                display: inline-block;
                float: right;
                font-size: 12px;
                margin-bottom: -2px;
                margin-top: -2px;
                min-height: 14px;
                min-width: 10px;
                padding: 3px 7px;
            }
            .badge.get
            {
                background-color: #3498db;
                color: white;
            }
            .badge.head
            {
                background-color: #3498db;
                color: white;
            }
            .badge.options
            {
                background-color: #3498db;
                color: white;
            }
            .badge.put
            {
                background-color: #f39c12;
                color: white;
            }
            .badge.patch
            {
                background-color: #f39c12;
                color: white;
            }
            .badge.post, .badge.any
            {
                background-color: #18bc9c;
                color: white;
            }
            .badge.delete
            {
                background-color: #e74c3c;
                color: white;
            }
            .collapse-button
            {
                float: right;
            }
            .collapse-button .close
            {
                color: #18bc9c;
                cursor: pointer;
                display: none;
            }
            .collapse-button .open
            {
                color: #18bc9c;
                cursor: pointer;
            }
            .collapse-button.show .close
            {
                display: inline;
            }
            .collapse-button.show .open
            {
                display: none;
            }
            .collapse-content
            {
                max-height: 0;
                overflow: hidden;
                transition: max-height .3s ease-in-out;
            }
            nav
            {
                width: 220px;
            }
            .container
            {
                margin-left: auto;
                margin-right: auto;
                max-width: 940px;
            }
            .container .row .content
            {
                margin-left: 244px;
                width: 696px;
            }
            .container .row:after
            {
                clear: both;
                content: '';
                display: block;
            }
            .container-fluid nav
            {
                width: 22%;
            }
            .container-fluid .row .content
            {
                margin-left: 24%;
                width: 76%;
            }
            @media (max-width:1200px)
            {
                nav
                {
                    width: 200px;
                }
                .container
                {
                    max-width: 840px;
                }
                .container .row .content
                {
                    margin-left: 224px;
                    width: 606px;
                }
            }
            @media (max-width:992px)
            {
                nav
                {
                    width: 170px;
                }
                .container
                {
                    max-width: 720px;
                }
                .container .row .content
                {
                    margin-left: 194px;
                    width: 526px;
                }
            }
            @media (max-width:768px)
            {
                nav
                {
                    display: none;
                }
                .container
                {
                    max-width: none;
                    width: 95%;
                }
                .container .row .content,.container-fluid .row .content
                {
                    margin-left: auto;
                    margin-right: auto;
                    width: 95%;
                }
            }
            .back-to-top
            {
                background-color: #ededed;
                border-left: 1px solid #ededed;
                border-right: 1px solid #ededed;
                border-top: 1px solid #ededed;
                border-top-left-radius: 3px;
                border-top-right-radius: 3px;
                bottom: 0;
                color: rgba(0,0,0,0.5);
                padding: 4px 8px;
                position: fixed;
                right: 24px;
                text-decoration: none !important;
                z-index: 1;
            }
            .resource-group
            {
                background-color: white;
                border: 1px solid #ededed;
                border-radius: 6px;
                margin-bottom: 12px;
                padding: 12px;
            }
            .resource-group h2.group-heading,.resource-group .heading a
            {
                background-color: #ededed;
                border-bottom: 1px solid #ededed;
                margin: -12px -12px 12px -12px;
                overflow: hidden;
                padding: 12px;
                white-space: nowrap;
            }
            nav .resource-group .heading a
            {
                margin-bottom: 0;
            }
            nav .resource-group .collapse-content
            {
                padding: 0;
            }
            .action
            {
                border: 1px solid transparent;
                border-radius: 6px;
                margin-bottom: 12px;
                overflow: hidden;
                padding: 12px 12px 0 12px;

            }
            .clickable {
                cursor: pointer;
            }

            .action h4.action-heading
            {
                border-bottom: 1px solid transparent;
                border-top-left-radius: 6px;
                border-top-right-radius: 6px;
                margin: -12px -12px 12px -12px;
                overflow: hidden;
                padding: 12px;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
            .action h4.action-heading .name
            {
                float: right;
                font-weight: normal;
            }
            .action h4.action-heading .method
            {
                border-radius: 3px;
                margin-right: 12px;
                padding: 6px 12px;
            }
            .action h4.action-heading .method.get
            {
                background-color: white;
                color: #000;
            }
            .action h4.action-heading .method.head
            {
                background-color: white;
                color: #000;
            }
            .action h4.action-heading .method.options
            {
                background-color: white;
                color: #000;
            }
            .action h4.action-heading .method.put
            {
                background-color: white;
                color: #000;
            }
            .action h4.action-heading .method.patch
            {
                background-color: white;
                color: #000;
            }
            .action h4.action-heading .method.post, action h4.action-heading .any
            {
                background-color: white;
                color: #000;
            }
            .action h4.action-heading .method.delete
            {
                background-color: white;
                color: #000;
            }
            .action h4.action-heading code
            {
                background-color: rgba(255,255,255,0.7);
                border-color: transparent;
                color: #444;
                font-weight: normal;
            }
            .action dl.inner
            {
                padding-bottom: 2px;
            }
            .action .title
            {
                border-bottom: 1px solid white;
                margin: 0 -12px -1px -12px;
                padding: 12px;
            }
            .action.get
            {
                border-color: #3498db;
            }
            .action.get h4.action-heading
            {
                background: #3498db;
                border-bottom-color: #3498db;
                color: white;
            }
            .action.post
            {
                border-color: #2F8E7B;
            }

            .action.any
            {
                border-color: #C97626;
            }
            .action.post h4.action-heading
            {
                background: #18bc9c;
                border-bottom-color: #18bc9c;
                color: white;
            }
            .action.put
            {
                border-color: #f39c12;
            }
            .action.put h4.action-heading
            {
                background: #f39c12;
                border-bottom-color: #f39c12;
                color: white;
            }
            .action.patch
            {
                border-color: #f39c12;
            }
            .action.patch h4.action-heading
            {
                background: #f39c12;
                border-bottom-color: #f39c12;
                color: white;
            }
            .action.delete
            {
                border-color: #e74c3c;
            }
            .action.delete h4.action-heading
            {
                background: #e74c3c;
                border-bottom-color: #e74c3c;
                color: white;
            }
            .show
            {
                display: initial;
            }
            .hide
            {
                display:none;
            }
            h4
            {
                margin-bottom: 0 !important;
            }
            .resource p
            {
                margin-top: 10px;
            }
            .method{
                background-color: white;
                color: #000;
            }
            .action.any h4.action-heading
            {
                background: #C97626;
                border-bottom-color: #C97626;
                color: white;
            }
        </style>
    </head>
    <body>
    <div class="container">
        <div class="row">

            <nav><small>Last updated: {{ $lastModified }}</small>
                <div class="resource-group">
                    <div class="heading">
                    @foreach ($apiData as $group => $elements)
                        <a href="#{{ $group }}-group">
                            {{ $group }}
                        </a>
                    @endforeach
                    </div>
                </div>
            </nav>
            <div class="content">
                <header>
                    <h1 id="top">ApiDocs</h1>
                </header>
                @foreach ($apiData as $group => $elements)
                    <section id="{{ $group }}-group" class="resource-group">
                    <h2 class="group-heading"><a href="#{{ $group }}-group">{{ $group }}</a></h2>

                    @foreach ($elements as $call)
                        <?php $elemID = $call['method'] . $call['path']; ?>
                        <div id="notes-note-list" class="resource">
                            <div id="{{ $elemID }}" class="action {{ $call['method'] }}">
                                <h4 class="action-heading clickable" onclick="toggle('{{ $elemID }}')">
                                    <div class="name">{{ $call['title'] }}</div>
                                    <a href="#{{ $elemID }}" class="method {{ $call['method'] }}">{{ $call['method'] }}
                                    <code class="uri">{{ $call['path'] }}</code></a>
                                </h4>

                                <div class="hide" id="{{ $elemID . '-info' }}">
                                    @if(isset($call['description']))
                                    <p>
                                        {{ $call['description'] }}
                                    </p>
                                    @endif

                                    @if(isset($call['param']))
                                    <p>
                                        <h4>Input</h4>
                                        @foreach ($call['param'] as $param)
                                          {{ $param }}<br/>
                                        @endforeach
                                    </p>
                                    @endif

                                    @if(isset($call['return']))
                                    <p>
                                        <h4>Output</h4>
                                        @foreach ($call['return'] as $return)
                                          {{ $return }}<br/>
                                        @endforeach
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                    </section>
                @endforeach
            </div>
        </div>
    </div>


    <script>
        function toggle(elemID) {
            var element = document.getElementById(elemID + '-info');

            if (element.className == "show")
            {
                element.className = "hide";
            }
            else
            {
                element.className = "show";
            }
        }
    </script>
    </body>
</html>
