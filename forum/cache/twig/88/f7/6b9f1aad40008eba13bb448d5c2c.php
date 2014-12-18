<?php

/* login_body.html */
class __TwigTemplate_88f76b9f1aad40008eba13bb448d5c2c extends Twig_Template
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
<script type=\"text/javascript\">
// <![CDATA[
\tonload_functions.push('document.getElementById(\"";
        // line 5
        if ((isset($context["S_ADMIN_AUTH"]) ? $context["S_ADMIN_AUTH"] : null)) {
            echo (isset($context["PASSWORD_CREDENTIAL"]) ? $context["PASSWORD_CREDENTIAL"] : null);
        } else {
            echo (isset($context["USERNAME_CREDENTIAL"]) ? $context["USERNAME_CREDENTIAL"] : null);
        }
        echo "\").focus();');
// ]]>
</script>

<form action=\"";
        // line 9
        echo (isset($context["S_LOGIN_ACTION"]) ? $context["S_LOGIN_ACTION"] : null);
        echo "\" method=\"post\" id=\"login\">
<div class=\"panel\">
\t<div class=\"inner\"><span class=\"corners-top\"><span></span></span>

\t<div class=\"content\">
\t\t<h2>";
        // line 14
        if ((isset($context["LOGIN_EXPLAIN"]) ? $context["LOGIN_EXPLAIN"] : null)) {
            echo (isset($context["LOGIN_EXPLAIN"]) ? $context["LOGIN_EXPLAIN"] : null);
        } else {
            echo $this->env->getExtension('phpbb')->lang("LOGIN");
        }
        echo "</h2>

\t\t<fieldset ";
        // line 16
        if ((!(isset($context["S_CONFIRM_CODE"]) ? $context["S_CONFIRM_CODE"] : null))) {
            echo "class=\"fields1\"";
        } else {
            echo "class=\"fields2\"";
        }
        echo ">
\t\t";
        // line 17
        if ((isset($context["LOGIN_ERROR"]) ? $context["LOGIN_ERROR"] : null)) {
            echo "<div class=\"error\">";
            echo (isset($context["LOGIN_ERROR"]) ? $context["LOGIN_ERROR"] : null);
            echo "</div>";
        }
        // line 18
        echo "\t\t<dl>
\t\t\t<dt><label for=\"";
        // line 19
        echo (isset($context["USERNAME_CREDENTIAL"]) ? $context["USERNAME_CREDENTIAL"] : null);
        echo "\">";
        echo $this->env->getExtension('phpbb')->lang("USERNAME");
        echo ":</label></dt>
\t\t\t<dd><input type=\"text\" tabindex=\"1\" name=\"";
        // line 20
        echo (isset($context["USERNAME_CREDENTIAL"]) ? $context["USERNAME_CREDENTIAL"] : null);
        echo "\" id=\"";
        echo (isset($context["USERNAME_CREDENTIAL"]) ? $context["USERNAME_CREDENTIAL"] : null);
        echo "\" size=\"25\" value=\"";
        echo (isset($context["USERNAME"]) ? $context["USERNAME"] : null);
        echo "\" class=\"inputbox autowidth\" /></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"";
        // line 23
        echo (isset($context["PASSWORD_CREDENTIAL"]) ? $context["PASSWORD_CREDENTIAL"] : null);
        echo "\">";
        echo $this->env->getExtension('phpbb')->lang("PASSWORD");
        echo ":</label></dt>
\t\t\t<dd><input type=\"password\" tabindex=\"2\" id=\"";
        // line 24
        echo (isset($context["PASSWORD_CREDENTIAL"]) ? $context["PASSWORD_CREDENTIAL"] : null);
        echo "\" name=\"";
        echo (isset($context["PASSWORD_CREDENTIAL"]) ? $context["PASSWORD_CREDENTIAL"] : null);
        echo "\" size=\"25\" class=\"inputbox autowidth\" /></dd>
\t\t\t";
        // line 25
        if (((isset($context["S_DISPLAY_FULL_LOGIN"]) ? $context["S_DISPLAY_FULL_LOGIN"] : null) && ((isset($context["U_SEND_PASSWORD"]) ? $context["U_SEND_PASSWORD"] : null) || (isset($context["U_RESEND_ACTIVATION"]) ? $context["U_RESEND_ACTIVATION"] : null)))) {
            // line 26
            echo "\t\t\t\t";
            if ((isset($context["U_SEND_PASSWORD"]) ? $context["U_SEND_PASSWORD"] : null)) {
                echo "<dd><a href=\"";
                echo (isset($context["U_SEND_PASSWORD"]) ? $context["U_SEND_PASSWORD"] : null);
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("FORGOT_PASS");
                echo "</a></dd>";
            }
            // line 27
            echo "\t\t\t\t";
            if ((isset($context["U_RESEND_ACTIVATION"]) ? $context["U_RESEND_ACTIVATION"] : null)) {
                echo "<dd><a href=\"";
                echo (isset($context["U_RESEND_ACTIVATION"]) ? $context["U_RESEND_ACTIVATION"] : null);
                echo "\">";
                echo $this->env->getExtension('phpbb')->lang("RESEND_ACTIVATION");
                echo "</a></dd>";
            }
            // line 28
            echo "\t\t\t";
        }
        // line 29
        echo "\t\t</dl>
\t\t";
        // line 30
        if (((isset($context["CAPTCHA_TEMPLATE"]) ? $context["CAPTCHA_TEMPLATE"] : null) && (isset($context["S_CONFIRM_CODE"]) ? $context["S_CONFIRM_CODE"] : null))) {
            // line 31
            echo "\t\t\t";
            $value = 3;
            $context['definition']->set('CAPTCHA_TAB_INDEX', $value);
            // line 32
            echo "\t\t\t";
            $location = (("" . (isset($context["CAPTCHA_TEMPLATE"]) ? $context["CAPTCHA_TEMPLATE"] : null)) . "");
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $template = $this->env->resolveTemplate((("" . (isset($context["CAPTCHA_TEMPLATE"]) ? $context["CAPTCHA_TEMPLATE"] : null)) . ""));
            $template->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
            // line 33
            echo "\t\t";
        }
        // line 34
        echo "\t\t";
        if ((isset($context["S_DISPLAY_FULL_LOGIN"]) ? $context["S_DISPLAY_FULL_LOGIN"] : null)) {
            // line 35
            echo "\t\t<dl>
\t\t\t";
            // line 36
            if ((isset($context["S_AUTOLOGIN_ENABLED"]) ? $context["S_AUTOLOGIN_ENABLED"] : null)) {
                echo "<dd><label for=\"autologin\"><input type=\"checkbox\" name=\"autologin\" id=\"autologin\" tabindex=\"4\" /> ";
                echo $this->env->getExtension('phpbb')->lang("LOG_ME_IN");
                echo "</label></dd>";
            }
            // line 37
            echo "\t\t\t<dd><label for=\"viewonline\"><input type=\"checkbox\" name=\"viewonline\" id=\"viewonline\" tabindex=\"5\" /> ";
            echo $this->env->getExtension('phpbb')->lang("HIDE_ME");
            echo "</label></dd>
\t\t</dl>
\t\t";
        }
        // line 40
        echo "
\t\t";
        // line 41
        echo (isset($context["S_LOGIN_REDIRECT"]) ? $context["S_LOGIN_REDIRECT"] : null);
        echo "
\t\t<dl>
\t\t\t<dt>&nbsp;</dt>
\t\t\t<dd>";
        // line 44
        echo (isset($context["S_HIDDEN_FIELDS"]) ? $context["S_HIDDEN_FIELDS"] : null);
        echo "<input type=\"submit\" name=\"login\" tabindex=\"6\" value=\"";
        echo $this->env->getExtension('phpbb')->lang("LOGIN");
        echo "\" class=\"button1\" /></dd>
\t\t</dl>
\t\t</fieldset>
\t</div>
\t<span class=\"corners-bottom\"><span></span></span></div>
</div>


";
        // line 52
        if (((!(isset($context["S_ADMIN_AUTH"]) ? $context["S_ADMIN_AUTH"] : null)) && (isset($context["S_REGISTER_ENABLED"]) ? $context["S_REGISTER_ENABLED"] : null))) {
            // line 53
            echo "\t<div class=\"panel\">
\t\t<div class=\"inner\"><span class=\"corners-top\"><span></span></span>

\t\t<div class=\"content\">
\t\t\t<h3>";
            // line 57
            echo $this->env->getExtension('phpbb')->lang("REGISTER");
            echo "</h3>
\t\t\t<p>";
            // line 58
            echo $this->env->getExtension('phpbb')->lang("LOGIN_INFO");
            echo "</p>
\t\t\t<p><strong><a href=\"";
            // line 59
            echo (isset($context["U_TERMS_USE"]) ? $context["U_TERMS_USE"] : null);
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("TERMS_USE");
            echo "</a> | <a href=\"";
            echo (isset($context["U_PRIVACY"]) ? $context["U_PRIVACY"] : null);
            echo "\">";
            echo $this->env->getExtension('phpbb')->lang("PRIVACY");
            echo "</a></strong></p>
\t\t\t<hr class=\"dashed\" />
\t\t\t<p><a href=\"";
            // line 61
            echo (isset($context["U_REGISTER"]) ? $context["U_REGISTER"] : null);
            echo "\" class=\"button2\">";
            echo $this->env->getExtension('phpbb')->lang("REGISTER");
            echo "</a></p>
\t\t</div>

\t\t<span class=\"corners-bottom\"><span></span></span></div>
\t</div>
";
        }
        // line 67
        echo "
</form>

";
        // line 70
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
        return "login_body.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  242 => 70,  237 => 67,  226 => 61,  215 => 59,  211 => 58,  207 => 57,  201 => 53,  199 => 52,  186 => 44,  180 => 41,  177 => 40,  170 => 37,  164 => 36,  161 => 35,  158 => 34,  155 => 33,  141 => 32,  137 => 31,  135 => 30,  132 => 29,  129 => 28,  120 => 27,  111 => 26,  109 => 25,  103 => 24,  97 => 23,  87 => 20,  81 => 19,  78 => 18,  72 => 17,  64 => 16,  55 => 14,  47 => 9,  36 => 5,  31 => 2,  19 => 1,);
    }
}
