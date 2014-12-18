<?php

/* forumlist_body.html */
class __TwigTemplate_5d7b2f438b67ac89c84e6a444beec85b extends Twig_Template
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
        echo "
";
        // line 2
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "forumrow"));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["forumrow"]) {
            // line 3
            echo "\t";
            if ((($this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "S_IS_CAT") && (!$this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "S_FIRST_ROW"))) || $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "S_NO_CAT"))) {
                // line 4
                echo "\t\t\t</ul>

\t\t\t<span class=\"corners-bottom\"><span></span></span></div>
\t\t</div>
\t";
            }
            // line 9
            echo "
\t";
            // line 10
            if ((($this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "S_IS_CAT") || $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "S_FIRST_ROW")) || $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "S_NO_CAT"))) {
                // line 11
                echo "\t\t<div class=\"forabg\">
\t\t\t<div class=\"inner\"><span class=\"corners-top\"><span></span></span>
\t\t\t<ul class=\"topiclist\">
\t\t\t\t<li class=\"header\">
\t\t\t\t\t<dl class=\"icon\">
\t\t\t\t\t\t<dt>";
                // line 16
                if ($this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "S_IS_CAT")) {
                    echo "<a href=\"";
                    echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "U_VIEWFORUM");
                    echo "\">";
                    echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "FORUM_NAME");
                    echo "</a>";
                } else {
                    echo $this->env->getExtension('phpbb')->lang("FORUM");
                }
                echo "</dt>
\t\t\t\t\t\t<dd class=\"topics\">";
                // line 17
                echo $this->env->getExtension('phpbb')->lang("TOPICS");
                echo "</dd>
\t\t\t\t\t\t<dd class=\"posts\">";
                // line 18
                echo $this->env->getExtension('phpbb')->lang("POSTS");
                echo "</dd>
\t\t\t\t\t\t<dd class=\"lastpost\"><span>";
                // line 19
                echo $this->env->getExtension('phpbb')->lang("LAST_POST");
                echo "</span></dd>
\t\t\t\t\t</dl>
\t\t\t\t</li>
\t\t\t</ul>
\t\t\t<ul class=\"topiclist forums\">
\t";
            }
            // line 25
            echo "
\t";
            // line 26
            if ((!$this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "S_IS_CAT"))) {
                // line 27
                echo "\t\t<li class=\"row\">
\t\t\t<dl class=\"icon\" style=\"background-image: url(";
                // line 28
                echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "FORUM_FOLDER_IMG_SRC");
                echo "); background-repeat: no-repeat;\">
\t\t\t\t<dt title=\"";
                // line 29
                echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "FORUM_FOLDER_IMG_ALT");
                echo "\">
\t\t\t\t";
                // line 30
                if (((isset($context["S_ENABLE_FEEDS"]) ? $context["S_ENABLE_FEEDS"] : null) && $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "S_FEED_ENABLED"))) {
                    echo "<!-- <a class=\"feed-icon-forum\" title=\"";
                    echo $this->env->getExtension('phpbb')->lang("FEED");
                    echo " - ";
                    echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "FORUM_NAME");
                    echo "\" href=\"";
                    echo (isset($context["U_FEED"]) ? $context["U_FEED"] : null);
                    echo "?f=";
                    echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "FORUM_ID");
                    echo "\"><img src=\"";
                    echo (isset($context["T_THEME_PATH"]) ? $context["T_THEME_PATH"] : null);
                    echo "/images/feed.gif\" alt=\"";
                    echo $this->env->getExtension('phpbb')->lang("FEED");
                    echo " - ";
                    echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "FORUM_NAME");
                    echo "\" /></a> -->";
                }
                // line 31
                echo "
\t\t\t\t\t";
                // line 32
                if ($this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "FORUM_IMAGE")) {
                    echo "<span class=\"forum-image\">";
                    echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "FORUM_IMAGE");
                    echo "</span>";
                }
                // line 33
                echo "\t\t\t\t\t<a href=\"";
                echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "U_VIEWFORUM");
                echo "\" class=\"forumtitle\">";
                echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "FORUM_NAME");
                echo "</a><br />
\t\t\t\t\t";
                // line 34
                echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "FORUM_DESC");
                echo "
\t\t\t\t\t";
                // line 35
                if ($this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "MODERATORS")) {
                    // line 36
                    echo "\t\t\t\t\t\t<br /><strong>";
                    echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "L_MODERATOR_STR");
                    echo ":</strong> ";
                    echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "MODERATORS");
                    echo "
\t\t\t\t\t";
                }
                // line 38
                echo "\t\t\t\t\t";
                if (($this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "SUBFORUMS") && $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "S_LIST_SUBFORUMS"))) {
                    echo "<br /><strong>";
                    echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "L_SUBFORUM_STR");
                    echo "</strong> ";
                    echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "SUBFORUMS");
                }
                // line 39
                echo "\t\t\t\t</dt>
\t\t\t\t";
                // line 40
                if ($this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "CLICKS")) {
                    // line 41
                    echo "\t\t\t\t\t<dd class=\"redirect\"><span>";
                    echo $this->env->getExtension('phpbb')->lang("REDIRECTS");
                    echo ": ";
                    echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "CLICKS");
                    echo "</span></dd>
\t\t\t\t";
                } elseif ((!$this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "S_IS_LINK"))) {
                    // line 43
                    echo "\t\t\t\t\t<dd class=\"topics\">";
                    echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "TOPICS");
                    echo " <dfn>";
                    echo $this->env->getExtension('phpbb')->lang("TOPICS");
                    echo "</dfn></dd>
\t\t\t\t\t<dd class=\"posts\">";
                    // line 44
                    echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "POSTS");
                    echo " <dfn>";
                    echo $this->env->getExtension('phpbb')->lang("POSTS");
                    echo "</dfn></dd>
\t\t\t\t\t<dd class=\"lastpost\"><span>
\t\t\t\t\t\t";
                    // line 46
                    if ($this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "U_UNAPPROVED_TOPICS")) {
                        echo "<a href=\"";
                        echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "U_UNAPPROVED_TOPICS");
                        echo "\">";
                        echo (isset($context["UNAPPROVED_IMG"]) ? $context["UNAPPROVED_IMG"] : null);
                        echo "</a>";
                    }
                    // line 47
                    echo "\t\t\t\t\t\t";
                    if ($this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "LAST_POST_TIME")) {
                        echo "<dfn>";
                        echo $this->env->getExtension('phpbb')->lang("LAST_POST");
                        echo "</dfn> ";
                        echo $this->env->getExtension('phpbb')->lang("POST_BY_AUTHOR");
                        echo " ";
                        echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "LAST_POSTER_FULL");
                        echo "
\t\t\t\t\t\t";
                        // line 48
                        if ((!(isset($context["S_IS_BOT"]) ? $context["S_IS_BOT"] : null))) {
                            echo "<a href=\"";
                            echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "U_LAST_POST");
                            echo "\">";
                            echo (isset($context["LAST_POST_IMG"]) ? $context["LAST_POST_IMG"] : null);
                            echo "</a> ";
                        }
                        echo "<br />";
                        echo $this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "LAST_POST_TIME");
                    } else {
                        echo $this->env->getExtension('phpbb')->lang("NO_POSTS");
                        echo "<br />&nbsp;";
                    }
                    echo "</span>
\t\t\t\t\t</dd>
\t\t\t\t";
                }
                // line 51
                echo "\t\t\t</dl>
\t\t</li>
\t";
            }
            // line 54
            echo "
\t";
            // line 55
            if ($this->getAttribute((isset($context["forumrow"]) ? $context["forumrow"] : null), "S_LAST_ROW")) {
                // line 56
                echo "\t\t\t</ul>

\t\t\t<span class=\"corners-bottom\"><span></span></span></div>
\t\t</div>
\t";
            }
            // line 61
            echo "
";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 63
            echo "\t<div class=\"panel\">
\t\t<div class=\"inner\"><span class=\"corners-top\"><span></span></span>
\t\t<strong>";
            // line 65
            echo $this->env->getExtension('phpbb')->lang("NO_FORUMS");
            echo "</strong>
\t\t<span class=\"corners-bottom\"><span></span></span></div>
\t</div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['forumrow'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "forumlist_body.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  241 => 65,  237 => 63,  231 => 61,  224 => 56,  222 => 55,  219 => 54,  214 => 51,  196 => 48,  185 => 47,  177 => 46,  170 => 44,  155 => 41,  153 => 40,  150 => 39,  142 => 38,  134 => 36,  132 => 35,  128 => 34,  121 => 33,  115 => 32,  112 => 31,  94 => 30,  90 => 29,  86 => 28,  83 => 27,  81 => 26,  78 => 25,  65 => 18,  49 => 16,  42 => 11,  40 => 10,  37 => 9,  30 => 4,  27 => 3,  22 => 2,  269 => 48,  266 => 47,  255 => 45,  250 => 44,  248 => 43,  245 => 42,  233 => 40,  228 => 39,  226 => 38,  223 => 37,  212 => 35,  201 => 34,  188 => 33,  186 => 32,  183 => 31,  176 => 27,  171 => 26,  165 => 24,  163 => 43,  157 => 22,  151 => 21,  136 => 19,  131 => 18,  129 => 17,  126 => 16,  114 => 15,  111 => 14,  107 => 12,  98 => 11,  71 => 9,  69 => 19,  66 => 7,  64 => 6,  61 => 17,  47 => 4,  34 => 3,  31 => 2,  19 => 1,);
    }
}
