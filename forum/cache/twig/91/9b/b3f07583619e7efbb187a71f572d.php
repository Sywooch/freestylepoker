<?php

/* index_body.html */
class __TwigTemplate_919bb3f07583619e7efbb187a71f572d extends Twig_Template
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
        $location = "overall_header.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->env->loadTemplate("overall_header.html")->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<p class=\"";
        // line 3
        echo (isset($context["S_CONTENT_FLOW_END"]) ? $context["S_CONTENT_FLOW_END"] : null);
        if ((isset($context["S_USER_LOGGED_IN"]) ? $context["S_USER_LOGGED_IN"] : null)) {
            echo " rightside";
        }
        echo "\">";
        if ((isset($context["S_USER_LOGGED_IN"]) ? $context["S_USER_LOGGED_IN"] : null)) {
            echo (isset($context["LAST_VISIT_DATE"]) ? $context["LAST_VISIT_DATE"] : null);
        } else {
            echo (isset($context["CURRENT_TIME"]) ? $context["CURRENT_TIME"] : null);
        }
        echo "</p>
";
        // line 4
        if ((isset($context["U_MCP"]) ? $context["U_MCP"] : null)) {
            echo "<p>";
            echo (isset($context["CURRENT_TIME"]) ? $context["CURRENT_TIME"] : null);
            echo " <br />[&nbsp;<a href=\"";
            echo (isset($context["U_MCP"]) ? $context["U_MCP"] : null);
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("MCP");
            echo "</a>&nbsp;]</p>";
        } elseif ((isset($context["S_USER_LOGGED_IN"]) ? $context["S_USER_LOGGED_IN"] : null)) {
            echo "<p>";
            echo (isset($context["CURRENT_TIME"]) ? $context["CURRENT_TIME"] : null);
            echo "</p>";
        }
        // line 5
        echo "
";
        // line 6
        if (((isset($context["S_DISPLAY_SEARCH"]) ? $context["S_DISPLAY_SEARCH"] : null) || ((isset($context["S_USER_LOGGED_IN"]) ? $context["S_USER_LOGGED_IN"] : null) && (!(isset($context["S_IS_BOT"]) ? $context["S_IS_BOT"] : null))))) {
            // line 7
            echo "<ul class=\"linklist\">
\t";
            // line 8
            if ((isset($context["S_DISPLAY_SEARCH"]) ? $context["S_DISPLAY_SEARCH"] : null)) {
                // line 9
                echo "\t\t<li><a href=\"";
                echo (isset($context["U_SEARCH_UNANSWERED"]) ? $context["U_SEARCH_UNANSWERED"] : null);
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("SEARCH_UNANSWERED");
                echo "</a>";
                if ((isset($context["S_LOAD_UNREADS"]) ? $context["S_LOAD_UNREADS"] : null)) {
                    echo " &bull; <a href=\"";
                    echo (isset($context["U_SEARCH_UNREAD"]) ? $context["U_SEARCH_UNREAD"] : null);
                    echo "\">";
                    echo $this->env->getExtension('phpbb')->lang("SEARCH_UNREAD");
                    echo "</a>";
                }
                if ((isset($context["S_USER_LOGGED_IN"]) ? $context["S_USER_LOGGED_IN"] : null)) {
                    echo " &bull; <a href=\"";
                    echo (isset($context["U_SEARCH_NEW"]) ? $context["U_SEARCH_NEW"] : null);
                    echo "\">";
                    echo $this->env->getExtension('phpbb')->lang("SEARCH_NEW");
                    echo "</a>";
                }
                echo " &bull; <a href=\"";
                echo (isset($context["U_SEARCH_ACTIVE_TOPICS"]) ? $context["U_SEARCH_ACTIVE_TOPICS"] : null);
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("SEARCH_ACTIVE_TOPICS");
                echo "</a></li>
\t";
            }
            // line 11
            echo "\t";
            if (((!(isset($context["S_IS_BOT"]) ? $context["S_IS_BOT"] : null)) && (isset($context["U_MARK_FORUMS"]) ? $context["U_MARK_FORUMS"] : null))) {
                echo "<li class=\"rightside\"><a href=\"";
                echo (isset($context["U_MARK_FORUMS"]) ? $context["U_MARK_FORUMS"] : null);
                echo "\" accesskey=\"m\">";
                echo $this->env->getExtension('phpbb')->lang("MARK_FORUMS_READ");
                echo "</a></li>";
            }
            // line 12
            echo "</ul>
";
        }
        // line 14
        echo "
";
        // line 15
        $location = "forumlist_body.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->env->loadTemplate("forumlist_body.html")->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 16
        echo "
";
        // line 17
        if (((!(isset($context["S_USER_LOGGED_IN"]) ? $context["S_USER_LOGGED_IN"] : null)) && (!(isset($context["S_IS_BOT"]) ? $context["S_IS_BOT"] : null)))) {
            // line 18
            echo "\t<form method=\"post\" action=\"";
            echo (isset($context["S_LOGIN_ACTION"]) ? $context["S_LOGIN_ACTION"] : null);
            echo "\" class=\"headerspace\">
\t<h3><a href=\"";
            // line 19
            echo (isset($context["U_LOGIN_LOGOUT"]) ? $context["U_LOGIN_LOGOUT"] : null);
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("LOGIN_LOGOUT");
            echo "</a>";
            if ((isset($context["S_REGISTER_ENABLED"]) ? $context["S_REGISTER_ENABLED"] : null)) {
                echo "&nbsp; &bull; &nbsp;<a href=\"";
                echo (isset($context["U_REGISTER"]) ? $context["U_REGISTER"] : null);
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("REGISTER");
                echo "</a>";
            }
            echo "</h3>
\t\t<fieldset class=\"quick-login\">
\t\t\t<label for=\"username\">";
            // line 21
            echo $this->env->getExtension('phpbb')->lang("USERNAME");
            echo ":</label>&nbsp;<input type=\"text\" name=\"username\" id=\"username\" size=\"10\" class=\"inputbox\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("USERNAME");
            echo "\" />
\t\t\t<label for=\"password\">";
            // line 22
            echo $this->env->getExtension('phpbb')->lang("PASSWORD");
            echo ":</label>&nbsp;<input type=\"password\" name=\"password\" id=\"password\" size=\"10\" class=\"inputbox\" title=\"";
            echo $this->env->getExtension('phpbb')->lang("PASSWORD");
            echo "\" />
\t\t\t";
            // line 23
            if ((isset($context["S_AUTOLOGIN_ENABLED"]) ? $context["S_AUTOLOGIN_ENABLED"] : null)) {
                // line 24
                echo "\t\t\t\t| <label for=\"autologin\">";
                echo $this->env->getExtension('phpbb')->lang("LOG_ME_IN");
                echo " <input type=\"checkbox\" name=\"autologin\" id=\"autologin\" /></label>
\t\t\t";
            }
            // line 26
            echo "\t\t\t<input type=\"submit\" name=\"login\" value=\"";
            echo $this->env->getExtension('phpbb')->lang("LOGIN");
            echo "\" class=\"button2\" />
\t\t\t";
            // line 27
            echo (isset($context["S_LOGIN_REDIRECT"]) ? $context["S_LOGIN_REDIRECT"] : null);
            echo "
\t\t</fieldset>
\t</form>
";
        }
        // line 31
        echo "
";
        // line 32
        if ((isset($context["S_DISPLAY_ONLINE_LIST"]) ? $context["S_DISPLAY_ONLINE_LIST"] : null)) {
            // line 33
            echo "\t";
            if ((isset($context["U_VIEWONLINE"]) ? $context["U_VIEWONLINE"] : null)) {
                echo "<h3><a href=\"";
                echo (isset($context["U_VIEWONLINE"]) ? $context["U_VIEWONLINE"] : null);
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("WHO_IS_ONLINE");
                echo "</a></h3>";
            } else {
                echo "<h3>";
                echo $this->env->getExtension('phpbb')->lang("WHO_IS_ONLINE");
                echo "</h3>";
            }
            // line 34
            echo "\t<p>";
            echo (isset($context["TOTAL_USERS_ONLINE"]) ? $context["TOTAL_USERS_ONLINE"] : null);
            echo " (";
            echo $this->env->getExtension('phpbb')->lang("ONLINE_EXPLAIN");
            echo ")<br />";
            echo (isset($context["RECORD_USERS"]) ? $context["RECORD_USERS"] : null);
            echo "<br /> <br />";
            echo (isset($context["LOGGED_IN_USER_LIST"]) ? $context["LOGGED_IN_USER_LIST"] : null);
            echo "
\t";
            // line 35
            if ((isset($context["LEGEND"]) ? $context["LEGEND"] : null)) {
                echo "<br /><em>";
                echo $this->env->getExtension('phpbb')->lang("LEGEND");
                echo ": ";
                echo (isset($context["LEGEND"]) ? $context["LEGEND"] : null);
                echo "</em>";
            }
            echo "</p>
";
        }
        // line 37
        echo "
";
        // line 38
        if (((isset($context["S_DISPLAY_BIRTHDAY_LIST"]) ? $context["S_DISPLAY_BIRTHDAY_LIST"] : null) && (isset($context["BIRTHDAY_LIST"]) ? $context["BIRTHDAY_LIST"] : null))) {
            // line 39
            echo "\t<h3>";
            echo $this->env->getExtension('phpbb')->lang("BIRTHDAYS");
            echo "</h3>
\t<p>";
            // line 40
            if ((isset($context["BIRTHDAY_LIST"]) ? $context["BIRTHDAY_LIST"] : null)) {
                echo $this->env->getExtension('phpbb')->lang("CONGRATULATIONS");
                echo ": <strong>";
                echo (isset($context["BIRTHDAY_LIST"]) ? $context["BIRTHDAY_LIST"] : null);
                echo "</strong>";
            } else {
                echo $this->env->getExtension('phpbb')->lang("NO_BIRTHDAYS");
            }
            echo "</p>
";
        }
        // line 42
        echo "
";
        // line 43
        if ((isset($context["NEWEST_USER"]) ? $context["NEWEST_USER"] : null)) {
            // line 44
            echo "\t<h3>";
            echo $this->env->getExtension('phpbb')->lang("STATISTICS");
            echo "</h3>
\t<p>";
            // line 45
            echo (isset($context["TOTAL_POSTS"]) ? $context["TOTAL_POSTS"] : null);
            echo " &bull; ";
            echo (isset($context["TOTAL_TOPICS"]) ? $context["TOTAL_TOPICS"] : null);
            echo " &bull; ";
            echo (isset($context["TOTAL_USERS"]) ? $context["TOTAL_USERS"] : null);
            echo " &bull; ";
            echo (isset($context["NEWEST_USER"]) ? $context["NEWEST_USER"] : null);
            echo "</p>
";
        }
        // line 47
        echo "
";
        // line 48
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->env->loadTemplate("overall_footer.html")->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "index_body.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  269 => 48,  266 => 47,  255 => 45,  250 => 44,  248 => 43,  245 => 42,  233 => 40,  228 => 39,  226 => 38,  223 => 37,  212 => 35,  201 => 34,  188 => 33,  186 => 32,  183 => 31,  176 => 27,  171 => 26,  165 => 24,  163 => 23,  157 => 22,  151 => 21,  136 => 19,  131 => 18,  129 => 17,  126 => 16,  114 => 15,  111 => 14,  107 => 12,  98 => 11,  71 => 9,  69 => 8,  66 => 7,  64 => 6,  61 => 5,  47 => 4,  34 => 3,  31 => 2,  19 => 1,);
    }
}
