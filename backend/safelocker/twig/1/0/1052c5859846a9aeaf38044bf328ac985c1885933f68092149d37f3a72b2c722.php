<?php

/* layout.html.twig */
class __TwigTemplate_1052c5859846a9aeaf38044bf328ac985c1885933f68092149d37f3a72b2c722 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_24d1b621025065a1352eddcfa048a28015df42d9c19df8685262a282f069c3b4 = $this->env->getExtension("native_profiler");
        $__internal_24d1b621025065a1352eddcfa048a28015df42d9c19df8685262a282f069c3b4->enter($__internal_24d1b621025065a1352eddcfa048a28015df42d9c19df8685262a282f069c3b4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "layout.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <title>";
        // line 4
        $this->displayBlock('title', $context, $blocks);
        echo " - My Silex Application</title>

        <link href=\"";
        // line 6
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('asset')->getCallable(), array("css/main.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />

        <script type=\"text/javascript\">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>
    </head>
    <body>
        ";
        // line 21
        $this->displayBlock('content', $context, $blocks);
        // line 22
        echo "    </body>
</html>
";
        
        $__internal_24d1b621025065a1352eddcfa048a28015df42d9c19df8685262a282f069c3b4->leave($__internal_24d1b621025065a1352eddcfa048a28015df42d9c19df8685262a282f069c3b4_prof);

    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
        $__internal_d3b902a86186cc903971997ae2a4aa8036ee89f4f9570079f8a0930b028b6af0 = $this->env->getExtension("native_profiler");
        $__internal_d3b902a86186cc903971997ae2a4aa8036ee89f4f9570079f8a0930b028b6af0->enter($__internal_d3b902a86186cc903971997ae2a4aa8036ee89f4f9570079f8a0930b028b6af0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "";
        
        $__internal_d3b902a86186cc903971997ae2a4aa8036ee89f4f9570079f8a0930b028b6af0->leave($__internal_d3b902a86186cc903971997ae2a4aa8036ee89f4f9570079f8a0930b028b6af0_prof);

    }

    // line 21
    public function block_content($context, array $blocks = array())
    {
        $__internal_c1247410a4f7fc8de183df03797017c704544a0f269fdb25714172b1ac2e61de = $this->env->getExtension("native_profiler");
        $__internal_c1247410a4f7fc8de183df03797017c704544a0f269fdb25714172b1ac2e61de->enter($__internal_c1247410a4f7fc8de183df03797017c704544a0f269fdb25714172b1ac2e61de_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        
        $__internal_c1247410a4f7fc8de183df03797017c704544a0f269fdb25714172b1ac2e61de->leave($__internal_c1247410a4f7fc8de183df03797017c704544a0f269fdb25714172b1ac2e61de_prof);

    }

    public function getTemplateName()
    {
        return "layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  75 => 21,  63 => 4,  54 => 22,  52 => 21,  34 => 6,  29 => 4,  24 => 1,);
    }
}
