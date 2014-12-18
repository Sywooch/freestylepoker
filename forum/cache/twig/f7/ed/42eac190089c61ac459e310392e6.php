<?php

/* overall_footer.html */
class __TwigTemplate_f7ed42eac190089c61ac459e310392e6 extends Twig_Template
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
        echo "\t</div>

<div id=\"page-footer\">

\t<div class=\"navbar\">
\t\t<div class=\"inner\"><span class=\"corners-top\"><span></span></span>

\t\t<ul class=\"linklist\">
\t\t\t<li class=\"icon-home\"><a href=\"";
        // line 9
        echo (isset($context["U_INDEX"]) ? $context["U_INDEX"] : null);
        echo "\" accesskey=\"h\">";
        echo $this->env->getExtension('phpbb')->lang("INDEX");
        echo "</a></li>
\t\t\t\t";
        // line 10
        if ((!(isset($context["S_IS_BOT"]) ? $context["S_IS_BOT"] : null))) {
            // line 11
            echo "\t\t\t\t\t";
            if ((isset($context["S_WATCH_FORUM_LINK"]) ? $context["S_WATCH_FORUM_LINK"] : null)) {
                echo "<li ";
                if ((isset($context["S_WATCHING_FORUM"]) ? $context["S_WATCHING_FORUM"] : null)) {
                    echo "class=\"icon-unsubscribe\"";
                } else {
                    echo "class=\"icon-subscribe\"";
                }
                echo "><a href=\"";
                echo (isset($context["S_WATCH_FORUM_LINK"]) ? $context["S_WATCH_FORUM_LINK"] : null);
                echo "\" title=\"";
                echo (isset($context["S_WATCH_FORUM_TITLE"]) ? $context["S_WATCH_FORUM_TITLE"] : null);
                echo "\">";
                echo (isset($context["S_WATCH_FORUM_TITLE"]) ? $context["S_WATCH_FORUM_TITLE"] : null);
                echo "</a></li>";
            }
            // line 12
            echo "\t\t\t\t\t";
            if ((isset($context["U_WATCH_TOPIC"]) ? $context["U_WATCH_TOPIC"] : null)) {
                echo "<li ";
                if ((isset($context["S_WATCHING_TOPIC"]) ? $context["S_WATCHING_TOPIC"] : null)) {
                    echo "class=\"icon-unsubscribe\"";
                } else {
                    echo "class=\"icon-subscribe\"";
                }
                echo "><a href=\"";
                echo (isset($context["U_WATCH_TOPIC"]) ? $context["U_WATCH_TOPIC"] : null);
                echo "\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("WATCH_TOPIC");
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("WATCH_TOPIC");
                echo "</a></li>";
            }
            // line 13
            echo "\t\t\t\t\t";
            if ((isset($context["U_BOOKMARK_TOPIC"]) ? $context["U_BOOKMARK_TOPIC"] : null)) {
                echo "<li class=\"icon-bookmark\"><a href=\"";
                echo (isset($context["U_BOOKMARK_TOPIC"]) ? $context["U_BOOKMARK_TOPIC"] : null);
                echo "\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("BOOKMARK_TOPIC");
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("BOOKMARK_TOPIC");
                echo "</a></li>";
            }
            // line 14
            echo "\t\t\t\t\t";
            if ((isset($context["U_BUMP_TOPIC"]) ? $context["U_BUMP_TOPIC"] : null)) {
                echo "<li class=\"icon-bump\"><a href=\"";
                echo (isset($context["U_BUMP_TOPIC"]) ? $context["U_BUMP_TOPIC"] : null);
                echo "\" title=\"";
                echo $this->env->getExtension('phpbb')->lang("BUMP_TOPIC");
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("BUMP_TOPIC");
                echo "</a></li>";
            }
            // line 15
            echo "\t\t\t\t";
        }
        // line 16
        echo "\t\t\t<li class=\"rightside\">";
        if ((isset($context["U_TEAM"]) ? $context["U_TEAM"] : null)) {
            echo "<a href=\"";
            echo (isset($context["U_TEAM"]) ? $context["U_TEAM"] : null);
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("THE_TEAM");
            echo "</a> &bull; ";
        }
        if ((!(isset($context["S_IS_BOT"]) ? $context["S_IS_BOT"] : null))) {
            echo "<a href=\"";
            echo (isset($context["U_DELETE_COOKIES"]) ? $context["U_DELETE_COOKIES"] : null);
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("DELETE_COOKIES");
            echo "</a> &bull; ";
        }
        echo (isset($context["S_TIMEZONE"]) ? $context["S_TIMEZONE"] : null);
        echo "</li>
\t\t</ul>

\t\t<span class=\"corners-bottom\"><span></span></span></div>
\t</div>

\t<div class=\"copyright\">";
        // line 22
        echo (isset($context["CREDIT_LINE"]) ? $context["CREDIT_LINE"] : null);
        echo "
\t\t";
        // line 23
        if ((isset($context["TRANSLATION_INFO"]) ? $context["TRANSLATION_INFO"] : null)) {
            echo "<br />";
            echo (isset($context["TRANSLATION_INFO"]) ? $context["TRANSLATION_INFO"] : null);
        }
        // line 24
        echo "\t\t";
        if ((isset($context["DEBUG_OUTPUT"]) ? $context["DEBUG_OUTPUT"] : null)) {
            echo "<br />";
            echo (isset($context["DEBUG_OUTPUT"]) ? $context["DEBUG_OUTPUT"] : null);
        }
        // line 25
        echo "\t\t";
        if ((isset($context["U_ACP"]) ? $context["U_ACP"] : null)) {
            echo "<br /><strong><a href=\"";
            echo (isset($context["U_ACP"]) ? $context["U_ACP"] : null);
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("ACP");
            echo "</a></strong>";
        }
        // line 26
        echo "\t</div>
</div>

</div>

<div>
\t<a id=\"bottom\" name=\"bottom\" accesskey=\"z\"></a>
\t";
        // line 33
        if ((!(isset($context["S_IS_BOT"]) ? $context["S_IS_BOT"] : null))) {
            echo (isset($context["RUN_CRON_TASK"]) ? $context["RUN_CRON_TASK"] : null);
        }
        // line 34
        echo "</div>

</body>
</html>";
    }

    public function getTemplateName()
    {
        return "overall_footer.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  157 => 34,  153 => 33,  144 => 26,  124 => 23,  96 => 16,  93 => 15,  82 => 14,  71 => 13,  54 => 12,  35 => 10,  29 => 9,  550 => 173,  546 => 171,  544 => 170,  533 => 161,  523 => 159,  514 => 158,  503 => 157,  501 => 156,  493 => 155,  489 => 153,  484 => 150,  477 => 148,  472 => 147,  465 => 145,  460 => 144,  452 => 143,  444 => 142,  440 => 140,  438 => 139,  434 => 137,  423 => 136,  412 => 135,  401 => 134,  391 => 133,  384 => 131,  364 => 129,  354 => 121,  340 => 116,  336 => 115,  322 => 114,  317 => 112,  314 => 111,  312 => 110,  306 => 107,  302 => 106,  298 => 105,  290 => 104,  276 => 95,  271 => 92,  265 => 90,  263 => 89,  258 => 87,  254 => 86,  250 => 85,  245 => 83,  241 => 82,  236 => 80,  232 => 79,  192 => 45,  190 => 44,  183 => 40,  178 => 38,  174 => 37,  166 => 35,  154 => 25,  136 => 23,  121 => 22,  110 => 21,  99 => 20,  88 => 19,  77 => 18,  66 => 17,  50 => 14,  46 => 13,  37 => 11,  32 => 5,  22 => 2,  242 => 70,  237 => 67,  226 => 61,  215 => 59,  211 => 58,  207 => 57,  201 => 53,  199 => 48,  186 => 44,  180 => 41,  177 => 40,  170 => 36,  164 => 36,  161 => 35,  158 => 34,  155 => 33,  141 => 32,  137 => 31,  135 => 25,  132 => 29,  129 => 24,  120 => 22,  111 => 26,  109 => 25,  103 => 24,  97 => 23,  87 => 20,  81 => 19,  78 => 18,  72 => 17,  64 => 16,  55 => 14,  47 => 9,  36 => 5,  31 => 2,  19 => 1,);
    }
}
