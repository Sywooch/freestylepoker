<?php

/* overall_header.html */
class __TwigTemplate_c3169d09d9120a7768f848ff8ea0e733 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" dir=\"";
        // line 2
        echo (isset($context["S_CONTENT_DIRECTION"]) ? $context["S_CONTENT_DIRECTION"] : null);
        echo "\" lang=\"";
        echo (isset($context["S_USER_LANG"]) ? $context["S_USER_LANG"] : null);
        echo "\" xml:lang=\"";
        echo (isset($context["S_USER_LANG"]) ? $context["S_USER_LANG"] : null);
        echo "\">
<head>

<meta http-equiv=\"content-type\" content=\"text/html; charset=";
        // line 5
        echo (isset($context["S_CONTENT_ENCODING"]) ? $context["S_CONTENT_ENCODING"] : null);
        echo "\" />
<meta http-equiv=\"content-style-type\" content=\"text/css\" />
<meta http-equiv=\"content-language\" content=\"";
        // line 7
        echo (isset($context["S_USER_LANG"]) ? $context["S_USER_LANG"] : null);
        echo "\" />
<meta http-equiv=\"imagetoolbar\" content=\"no\" />
<meta name=\"resource-type\" content=\"document\" />
<meta name=\"distribution\" content=\"global\" />
<meta name=\"keywords\" content=\"\" />
<meta name=\"description\" content=\"\" />
";
        // line 13
        echo (isset($context["META"]) ? $context["META"] : null);
        echo "
<title>";
        // line 14
        echo (isset($context["SITENAME"]) ? $context["SITENAME"] : null);
        echo " &bull; ";
        if ((isset($context["S_IN_MCP"]) ? $context["S_IN_MCP"] : null)) {
            echo $this->env->getExtension('phpbb')->lang("MCP");
            echo " &bull; ";
        } elseif ((isset($context["S_IN_UCP"]) ? $context["S_IN_UCP"] : null)) {
            echo $this->env->getExtension('phpbb')->lang("UCP");
            echo " &bull; ";
        }
        echo (isset($context["PAGE_TITLE"]) ? $context["PAGE_TITLE"] : null);
        echo "</title>

";
        // line 16
        if ((isset($context["S_ENABLE_FEEDS"]) ? $context["S_ENABLE_FEEDS"] : null)) {
            // line 17
            echo "\t";
            if ((isset($context["S_ENABLE_FEEDS_OVERALL"]) ? $context["S_ENABLE_FEEDS_OVERALL"] : null)) {
                echo "<link rel=\"alternate\" type=\"application/atom+xml\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("FEED");
                echo " - ";
                echo (isset($context["SITENAME"]) ? $context["SITENAME"] : null);
                echo "\" href=\"";
                echo (isset($context["U_FEED"]) ? $context["U_FEED"] : null);
                echo "\" />";
            }
            // line 18
            echo "\t";
            if ((isset($context["S_ENABLE_FEEDS_NEWS"]) ? $context["S_ENABLE_FEEDS_NEWS"] : null)) {
                echo "<link rel=\"alternate\" type=\"application/atom+xml\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("FEED");
                echo " - ";
                echo $this->env->getExtension('phpbb')->lang("FEED_NEWS");
                echo "\" href=\"";
                echo (isset($context["U_FEED"]) ? $context["U_FEED"] : null);
                echo "?mode=news\" />";
            }
            // line 19
            echo "\t";
            if ((isset($context["S_ENABLE_FEEDS_FORUMS"]) ? $context["S_ENABLE_FEEDS_FORUMS"] : null)) {
                echo "<link rel=\"alternate\" type=\"application/atom+xml\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("FEED");
                echo " - ";
                echo $this->env->getExtension('phpbb')->lang("ALL_FORUMS");
                echo "\" href=\"";
                echo (isset($context["U_FEED"]) ? $context["U_FEED"] : null);
                echo "?mode=forums\" />";
            }
            // line 20
            echo "\t";
            if ((isset($context["S_ENABLE_FEEDS_TOPICS"]) ? $context["S_ENABLE_FEEDS_TOPICS"] : null)) {
                echo "<link rel=\"alternate\" type=\"application/atom+xml\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("FEED");
                echo " - ";
                echo $this->env->getExtension('phpbb')->lang("FEED_TOPICS_NEW");
                echo "\" href=\"";
                echo (isset($context["U_FEED"]) ? $context["U_FEED"] : null);
                echo "?mode=topics\" />";
            }
            // line 21
            echo "\t";
            if ((isset($context["S_ENABLE_FEEDS_TOPICS_ACTIVE"]) ? $context["S_ENABLE_FEEDS_TOPICS_ACTIVE"] : null)) {
                echo "<link rel=\"alternate\" type=\"application/atom+xml\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("FEED");
                echo " - ";
                echo $this->env->getExtension('phpbb')->lang("FEED_TOPICS_ACTIVE");
                echo "\" href=\"";
                echo (isset($context["U_FEED"]) ? $context["U_FEED"] : null);
                echo "?mode=topics_active\" />";
            }
            // line 22
            echo "\t";
            if (((isset($context["S_ENABLE_FEEDS_FORUM"]) ? $context["S_ENABLE_FEEDS_FORUM"] : null) && (isset($context["S_FORUM_ID"]) ? $context["S_FORUM_ID"] : null))) {
                echo "<link rel=\"alternate\" type=\"application/atom+xml\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("FEED");
                echo " - ";
                echo $this->env->getExtension('phpbb')->lang("FORUM");
                echo " - ";
                echo (isset($context["FORUM_NAME"]) ? $context["FORUM_NAME"] : null);
                echo "\" href=\"";
                echo (isset($context["U_FEED"]) ? $context["U_FEED"] : null);
                echo "?f=";
                echo (isset($context["S_FORUM_ID"]) ? $context["S_FORUM_ID"] : null);
                echo "\" />";
            }
            // line 23
            echo "\t";
            if (((isset($context["S_ENABLE_FEEDS_TOPIC"]) ? $context["S_ENABLE_FEEDS_TOPIC"] : null) && (isset($context["S_TOPIC_ID"]) ? $context["S_TOPIC_ID"] : null))) {
                echo "<link rel=\"alternate\" type=\"application/atom+xml\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("FEED");
                echo " - ";
                echo $this->env->getExtension('phpbb')->lang("TOPIC");
                echo " - ";
                echo (isset($context["TOPIC_TITLE"]) ? $context["TOPIC_TITLE"] : null);
                echo "\" href=\"";
                echo (isset($context["U_FEED"]) ? $context["U_FEED"] : null);
                echo "?f=";
                echo (isset($context["S_FORUM_ID"]) ? $context["S_FORUM_ID"] : null);
                echo "&amp;t=";
                echo (isset($context["S_TOPIC_ID"]) ? $context["S_TOPIC_ID"] : null);
                echo "\" />";
            }
        }
        // line 25
        echo "
<!--
\tphpBB style name: prosilver
\tBased on style:   prosilver (this is the default phpBB3 style)
\tOriginal author:  Tom Beddard ( http://www.subBlue.com/ )
\tModified by:
-->

<script type=\"text/javascript\">
// <![CDATA[
\tvar jump_page = '";
        // line 35
        echo addslashes($this->env->getExtension('phpbb')->lang("JUMP_PAGE"));
        echo ":';
\tvar on_page = '";
        // line 36
        echo (isset($context["ON_PAGE"]) ? $context["ON_PAGE"] : null);
        echo "';
\tvar per_page = '";
        // line 37
        echo (isset($context["PER_PAGE"]) ? $context["PER_PAGE"] : null);
        echo "';
\tvar base_url = '";
        // line 38
        echo (isset($context["A_BASE_URL"]) ? $context["A_BASE_URL"] : null);
        echo "';
\tvar style_cookie = 'phpBBstyle';
\tvar style_cookie_settings = '";
        // line 40
        echo (isset($context["A_COOKIE_SETTINGS"]) ? $context["A_COOKIE_SETTINGS"] : null);
        echo "';
\tvar onload_functions = new Array();
\tvar onunload_functions = new Array();

\t";
        // line 44
        if (((isset($context["S_USER_PM_POPUP"]) ? $context["S_USER_PM_POPUP"] : null) && (isset($context["S_NEW_PM"]) ? $context["S_NEW_PM"] : null))) {
            // line 45
            echo "\t\tvar url = '";
            echo (isset($context["UA_POPUP_PM"]) ? $context["UA_POPUP_PM"] : null);
            echo "';
\t\twindow.open(url.replace(/&amp;/g, '&'), '_phpbbprivmsg', 'height=225,resizable=yes,scrollbars=yes, width=400');
\t";
        }
        // line 48
        echo "
\t/**
\t* Find a member
\t*/
\tfunction find_username(url)
\t{
\t\tpopup(url, 760, 570, '_usersearch');
\t\treturn false;
\t}

\t/**
\t* New function for handling multiple calls to window.onload and window.unload by pentapenguin
\t*/
\twindow.onload = function()
\t{
\t\tfor (var i = 0; i < onload_functions.length; i++)
\t\t{
\t\t\teval(onload_functions[i]);
\t\t}
\t};

\twindow.onunload = function()
\t{
\t\tfor (var i = 0; i < onunload_functions.length; i++)
\t\t{
\t\t\teval(onunload_functions[i]);
\t\t}
\t};

// ]]>
</script>
<script type=\"text/javascript\" src=\"";
        // line 79
        echo (isset($context["T_SUPER_TEMPLATE_PATH"]) ? $context["T_SUPER_TEMPLATE_PATH"] : null);
        echo "/styleswitcher.js\"></script>
<script type=\"text/javascript\" src=\"";
        // line 80
        echo (isset($context["T_SUPER_TEMPLATE_PATH"]) ? $context["T_SUPER_TEMPLATE_PATH"] : null);
        echo "/forum_fn.js\"></script>

<link href=\"";
        // line 82
        echo (isset($context["T_THEME_PATH"]) ? $context["T_THEME_PATH"] : null);
        echo "/print.css\" rel=\"stylesheet\" type=\"text/css\" media=\"print\" title=\"printonly\" />
<link href=\"";
        // line 83
        echo (isset($context["T_STYLESHEET_LINK"]) ? $context["T_STYLESHEET_LINK"] : null);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"screen, projection\" />

<link href=\"";
        // line 85
        echo (isset($context["T_THEME_PATH"]) ? $context["T_THEME_PATH"] : null);
        echo "/normal.css\" rel=\"stylesheet\" type=\"text/css\" title=\"A\" />
<link href=\"";
        // line 86
        echo (isset($context["T_THEME_PATH"]) ? $context["T_THEME_PATH"] : null);
        echo "/medium.css\" rel=\"alternate stylesheet\" type=\"text/css\" title=\"A+\" />
<link href=\"";
        // line 87
        echo (isset($context["T_THEME_PATH"]) ? $context["T_THEME_PATH"] : null);
        echo "/large.css\" rel=\"alternate stylesheet\" type=\"text/css\" title=\"A++\" />

";
        // line 89
        if (((isset($context["S_CONTENT_DIRECTION"]) ? $context["S_CONTENT_DIRECTION"] : null) == "rtl")) {
            // line 90
            echo "\t<link href=\"";
            echo (isset($context["T_THEME_PATH"]) ? $context["T_THEME_PATH"] : null);
            echo "/bidi.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen, projection\" />
";
        }
        // line 92
        echo "
</head>

<body id=\"phpbb\" class=\"section-";
        // line 95
        echo (isset($context["SCRIPT_NAME"]) ? $context["SCRIPT_NAME"] : null);
        echo " ";
        echo (isset($context["S_CONTENT_DIRECTION"]) ? $context["S_CONTENT_DIRECTION"] : null);
        echo "\">

<div id=\"wrap\">
\t<a id=\"top\" name=\"top\" accesskey=\"t\"></a>
\t<div id=\"page-header\">
\t\t<div class=\"headerbar\">
\t\t\t<div class=\"inner\"><span class=\"corners-top\"><span></span></span>

\t\t\t<div id=\"site-description\">
\t\t\t\t<a href=\"";
        // line 104
        echo (isset($context["U_INDEX"]) ? $context["U_INDEX"] : null);
        echo "\" title=\"";
        echo $this->env->getExtension('phpbb')->lang("INDEX");
        echo "\" id=\"logo\">";
        echo (isset($context["SITE_LOGO_IMG"]) ? $context["SITE_LOGO_IMG"] : null);
        echo "</a>
\t\t\t\t<h1>";
        // line 105
        echo (isset($context["SITENAME"]) ? $context["SITENAME"] : null);
        echo "</h1>
\t\t\t\t<p>";
        // line 106
        echo (isset($context["SITE_DESCRIPTION"]) ? $context["SITE_DESCRIPTION"] : null);
        echo "</p>
\t\t\t\t<p class=\"skiplink\"><a href=\"#start_here\">";
        // line 107
        echo $this->env->getExtension('phpbb')->lang("SKIP");
        echo "</a></p>
\t\t\t</div>

\t\t";
        // line 110
        if (((isset($context["S_DISPLAY_SEARCH"]) ? $context["S_DISPLAY_SEARCH"] : null) && (!(isset($context["S_IN_SEARCH"]) ? $context["S_IN_SEARCH"] : null)))) {
            // line 111
            echo "\t\t\t<div id=\"search-box\">
\t\t\t\t<form action=\"";
            // line 112
            echo (isset($context["U_SEARCH"]) ? $context["U_SEARCH"] : null);
            echo "\" method=\"get\" id=\"search\">
\t\t\t\t<fieldset>
\t\t\t\t\t<input name=\"keywords\" id=\"keywords\" type=\"text\" maxlength=\"128\" title=\"";
            // line 114
            echo $this->env->getExtension('phpbb')->lang("SEARCH_KEYWORDS");
            echo "\" class=\"inputbox search\" value=\"";
            if ((isset($context["SEARCH_WORDS"]) ? $context["SEARCH_WORDS"] : null)) {
                echo (isset($context["SEARCH_WORDS"]) ? $context["SEARCH_WORDS"] : null);
            } else {
                echo $this->env->getExtension('phpbb')->lang("SEARCH_MINI");
            }
            echo "\" onclick=\"if(this.value=='";
            echo addslashes($this->env->getExtension('phpbb')->lang("SEARCH_MINI"));
            echo "')this.value='';\" onblur=\"if(this.value=='')this.value='";
            echo addslashes($this->env->getExtension('phpbb')->lang("SEARCH_MINI"));
            echo "';\" />
\t\t\t\t\t<input class=\"button2\" value=\"";
            // line 115
            echo $this->env->getExtension('phpbb')->lang("SEARCH");
            echo "\" type=\"submit\" /><br />
\t\t\t\t\t<a href=\"";
            // line 116
            echo (isset($context["U_SEARCH"]) ? $context["U_SEARCH"] : null);
            echo "\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("SEARCH_ADV_EXPLAIN");
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("SEARCH_ADV");
            echo "</a> ";
            echo (isset($context["S_SEARCH_HIDDEN_FIELDS"]) ? $context["S_SEARCH_HIDDEN_FIELDS"] : null);
            echo "
\t\t\t\t</fieldset>
\t\t\t\t</form>
\t\t\t</div>
\t\t";
        }
        // line 121
        echo "
\t\t\t<span class=\"corners-bottom\"><span></span></span></div>
\t\t</div>

\t\t<div class=\"navbar\">
\t\t\t<div class=\"inner\"><span class=\"corners-top\"><span></span></span>

\t\t\t<ul class=\"linklist navlinks\">
\t\t\t\t<li class=\"icon-home\"><a href=\"";
        // line 129
        echo (isset($context["U_INDEX"]) ? $context["U_INDEX"] : null);
        echo "\" accesskey=\"h\">";
        echo $this->env->getExtension('phpbb')->lang("INDEX");
        echo "</a> ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "navlinks"));
        foreach ($context['_seq'] as $context["_key"] => $context["navlinks"]) {
            echo " <strong>&#8249;</strong> <a href=\"";
            echo $this->getAttribute((isset($context["navlinks"]) ? $context["navlinks"] : null), "U_VIEW_FORUM");
            echo "\">";
            echo $this->getAttribute((isset($context["navlinks"]) ? $context["navlinks"] : null), "FORUM_NAME");
            echo "</a>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['navlinks'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo "</li>

\t\t\t\t<li class=\"rightside\"><a href=\"#\" onclick=\"fontsizeup(); return false;\" onkeypress=\"return fontsizeup(event);\" class=\"fontsize\" title=\"";
        // line 131
        echo $this->env->getExtension('phpbb')->lang("CHANGE_FONT_SIZE");
        echo "\">";
        echo $this->env->getExtension('phpbb')->lang("CHANGE_FONT_SIZE");
        echo "</a></li>

\t\t\t\t";
        // line 133
        if ((isset($context["U_EMAIL_TOPIC"]) ? $context["U_EMAIL_TOPIC"] : null)) {
            echo "<li class=\"rightside\"><a href=\"";
            echo (isset($context["U_EMAIL_TOPIC"]) ? $context["U_EMAIL_TOPIC"] : null);
            echo "\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("EMAIL_TOPIC");
            echo "\" class=\"sendemail\">";
            echo $this->env->getExtension('phpbb')->lang("EMAIL_TOPIC");
            echo "</a></li>";
        }
        // line 134
        echo "\t\t\t\t";
        if ((isset($context["U_EMAIL_PM"]) ? $context["U_EMAIL_PM"] : null)) {
            echo "<li class=\"rightside\"><a href=\"";
            echo (isset($context["U_EMAIL_PM"]) ? $context["U_EMAIL_PM"] : null);
            echo "\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("EMAIL_PM");
            echo "\" class=\"sendemail\">";
            echo $this->env->getExtension('phpbb')->lang("EMAIL_PM");
            echo "</a></li>";
        }
        // line 135
        echo "\t\t\t\t";
        if ((isset($context["U_PRINT_TOPIC"]) ? $context["U_PRINT_TOPIC"] : null)) {
            echo "<li class=\"rightside\"><a href=\"";
            echo (isset($context["U_PRINT_TOPIC"]) ? $context["U_PRINT_TOPIC"] : null);
            echo "\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("PRINT_TOPIC");
            echo "\" accesskey=\"p\" class=\"print\">";
            echo $this->env->getExtension('phpbb')->lang("PRINT_TOPIC");
            echo "</a></li>";
        }
        // line 136
        echo "\t\t\t\t";
        if ((isset($context["U_PRINT_PM"]) ? $context["U_PRINT_PM"] : null)) {
            echo "<li class=\"rightside\"><a href=\"";
            echo (isset($context["U_PRINT_PM"]) ? $context["U_PRINT_PM"] : null);
            echo "\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("PRINT_PM");
            echo "\" accesskey=\"p\" class=\"print\">";
            echo $this->env->getExtension('phpbb')->lang("PRINT_PM");
            echo "</a></li>";
        }
        // line 137
        echo "\t\t\t</ul>

\t\t\t";
        // line 139
        if (((!(isset($context["S_IS_BOT"]) ? $context["S_IS_BOT"] : null)) && (isset($context["S_USER_LOGGED_IN"]) ? $context["S_USER_LOGGED_IN"] : null))) {
            // line 140
            echo "\t\t\t<ul class=\"linklist leftside\">
\t\t\t\t<li class=\"icon-ucp\">
\t\t\t\t\t<a href=\"";
            // line 142
            echo (isset($context["U_PROFILE"]) ? $context["U_PROFILE"] : null);
            echo "\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("PROFILE");
            echo "\" accesskey=\"e\">";
            echo $this->env->getExtension('phpbb')->lang("PROFILE");
            echo "</a>
\t\t\t\t\t\t";
            // line 143
            if ((isset($context["S_DISPLAY_PM"]) ? $context["S_DISPLAY_PM"] : null)) {
                echo " (<a href=\"";
                echo (isset($context["U_PRIVATEMSGS"]) ? $context["U_PRIVATEMSGS"] : null);
                echo "\">";
                echo (isset($context["PRIVATE_MESSAGE_INFO"]) ? $context["PRIVATE_MESSAGE_INFO"] : null);
                echo "</a>)";
            }
            // line 144
            echo "\t\t\t\t\t";
            if ((isset($context["S_DISPLAY_SEARCH"]) ? $context["S_DISPLAY_SEARCH"] : null)) {
                echo " &bull;
\t\t\t\t\t<a href=\"";
                // line 145
                echo (isset($context["U_SEARCH_SELF"]) ? $context["U_SEARCH_SELF"] : null);
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("SEARCH_SELF");
                echo "</a>
\t\t\t\t\t";
            }
            // line 147
            echo "\t\t\t\t\t";
            if ((isset($context["U_RESTORE_PERMISSIONS"]) ? $context["U_RESTORE_PERMISSIONS"] : null)) {
                echo " &bull;
\t\t\t\t\t<a href=\"";
                // line 148
                echo (isset($context["U_RESTORE_PERMISSIONS"]) ? $context["U_RESTORE_PERMISSIONS"] : null);
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("RESTORE_PERMISSIONS");
                echo "</a>
\t\t\t\t\t";
            }
            // line 150
            echo "\t\t\t\t</li>
\t\t\t</ul>
\t\t\t";
        }
        // line 153
        echo "
\t\t\t<ul class=\"linklist rightside\">
\t\t\t\t<li class=\"icon-faq\"><a href=\"";
        // line 155
        echo (isset($context["U_FAQ"]) ? $context["U_FAQ"] : null);
        echo "\" title=\"";
        echo $this->env->getExtension('phpbb')->lang("FAQ_EXPLAIN");
        echo "\">";
        echo $this->env->getExtension('phpbb')->lang("FAQ");
        echo "</a></li>
\t\t\t\t";
        // line 156
        if ((!(isset($context["S_IS_BOT"]) ? $context["S_IS_BOT"] : null))) {
            // line 157
            echo "\t\t\t\t\t";
            if ((isset($context["S_DISPLAY_MEMBERLIST"]) ? $context["S_DISPLAY_MEMBERLIST"] : null)) {
                echo "<li class=\"icon-members\"><a href=\"";
                echo (isset($context["U_MEMBERLIST"]) ? $context["U_MEMBERLIST"] : null);
                echo "\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("MEMBERLIST_EXPLAIN");
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("MEMBERLIST");
                echo "</a></li>";
            }
            // line 158
            echo "\t\t\t\t\t";
            if ((((!(isset($context["S_USER_LOGGED_IN"]) ? $context["S_USER_LOGGED_IN"] : null)) && (isset($context["S_REGISTER_ENABLED"]) ? $context["S_REGISTER_ENABLED"] : null)) && (!((isset($context["S_SHOW_COPPA"]) ? $context["S_SHOW_COPPA"] : null) || (isset($context["S_REGISTRATION"]) ? $context["S_REGISTRATION"] : null))))) {
                echo "<li class=\"icon-register\"><a href=\"";
                echo (isset($context["U_REGISTER"]) ? $context["U_REGISTER"] : null);
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("REGISTER");
                echo "</a></li>";
            }
            // line 159
            echo "\t\t\t\t\t<li class=\"icon-logout\"><a href=\"";
            echo (isset($context["U_LOGIN_LOGOUT"]) ? $context["U_LOGIN_LOGOUT"] : null);
            echo "\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("LOGIN_LOGOUT");
            echo "\" accesskey=\"x\">";
            echo $this->env->getExtension('phpbb')->lang("LOGIN_LOGOUT");
            echo "</a></li>
\t\t\t\t";
        }
        // line 161
        echo "\t\t\t</ul>

\t\t\t<span class=\"corners-bottom\"><span></span></span></div>
\t\t</div>

\t</div>

\t<a name=\"start_here\"></a>
\t<div id=\"page-body\">
\t\t";
        // line 170
        if ((((isset($context["S_BOARD_DISABLED"]) ? $context["S_BOARD_DISABLED"] : null) && (isset($context["S_USER_LOGGED_IN"]) ? $context["S_USER_LOGGED_IN"] : null)) && ((isset($context["U_MCP"]) ? $context["U_MCP"] : null) || (isset($context["U_ACP"]) ? $context["U_ACP"] : null)))) {
            // line 171
            echo "\t\t<div id=\"information\" class=\"rules\">
\t\t\t<div class=\"inner\"><span class=\"corners-top\"><span></span></span>
\t\t\t\t<strong>";
            // line 173
            echo $this->env->getExtension('phpbb')->lang("INFORMATION");
            echo ":</strong> ";
            echo $this->env->getExtension('phpbb')->lang("BOARD_DISABLED");
            echo "
\t\t\t<span class=\"corners-bottom\"><span></span></span></div>
\t\t</div>
\t\t";
        }
    }

    public function getTemplateName()
    {
        return "overall_header.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  550 => 173,  546 => 171,  544 => 170,  533 => 161,  523 => 159,  514 => 158,  503 => 157,  501 => 156,  493 => 155,  489 => 153,  484 => 150,  477 => 148,  472 => 147,  465 => 145,  460 => 144,  452 => 143,  444 => 142,  440 => 140,  438 => 139,  434 => 137,  423 => 136,  412 => 135,  401 => 134,  391 => 133,  384 => 131,  364 => 129,  354 => 121,  340 => 116,  336 => 115,  322 => 114,  317 => 112,  314 => 111,  312 => 110,  306 => 107,  302 => 106,  298 => 105,  290 => 104,  276 => 95,  271 => 92,  265 => 90,  263 => 89,  258 => 87,  254 => 86,  250 => 85,  245 => 83,  241 => 82,  236 => 80,  232 => 79,  192 => 45,  190 => 44,  183 => 40,  178 => 38,  174 => 37,  166 => 35,  154 => 25,  136 => 23,  121 => 22,  110 => 21,  99 => 20,  88 => 19,  77 => 18,  66 => 17,  50 => 14,  46 => 13,  37 => 7,  32 => 5,  22 => 2,  242 => 70,  237 => 67,  226 => 61,  215 => 59,  211 => 58,  207 => 57,  201 => 53,  199 => 48,  186 => 44,  180 => 41,  177 => 40,  170 => 36,  164 => 36,  161 => 35,  158 => 34,  155 => 33,  141 => 32,  137 => 31,  135 => 30,  132 => 29,  129 => 28,  120 => 27,  111 => 26,  109 => 25,  103 => 24,  97 => 23,  87 => 20,  81 => 19,  78 => 18,  72 => 17,  64 => 16,  55 => 14,  47 => 9,  36 => 5,  31 => 2,  19 => 1,);
    }
}
