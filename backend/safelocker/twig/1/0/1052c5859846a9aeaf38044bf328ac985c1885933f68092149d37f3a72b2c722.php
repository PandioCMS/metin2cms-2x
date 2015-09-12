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
        $__internal_5ea8fd9ec1611ec580e5088653fa4908b262f9fe00cca08a59220780c041d7b5 = $this->env->getExtension("native_profiler");
        $__internal_5ea8fd9ec1611ec580e5088653fa4908b262f9fe00cca08a59220780c041d7b5->enter($__internal_5ea8fd9ec1611ec580e5088653fa4908b262f9fe00cca08a59220780c041d7b5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "layout.html.twig"));

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
        
        $__internal_5ea8fd9ec1611ec580e5088653fa4908b262f9fe00cca08a59220780c041d7b5->leave($__internal_5ea8fd9ec1611ec580e5088653fa4908b262f9fe00cca08a59220780c041d7b5_prof);

    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
        $__internal_19a0b4b8f4e500f31b7fab9a728f8f3407017ec406494ad7aaf57f4fe5f2bb5c = $this->env->getExtension("native_profiler");
        $__internal_19a0b4b8f4e500f31b7fab9a728f8f3407017ec406494ad7aaf57f4fe5f2bb5c->enter($__internal_19a0b4b8f4e500f31b7fab9a728f8f3407017ec406494ad7aaf57f4fe5f2bb5c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "";
        
        $__internal_19a0b4b8f4e500f31b7fab9a728f8f3407017ec406494ad7aaf57f4fe5f2bb5c->leave($__internal_19a0b4b8f4e500f31b7fab9a728f8f3407017ec406494ad7aaf57f4fe5f2bb5c_prof);

    }

    // line 21
    public function block_content($context, array $blocks = array())
    {
        $__internal_ed11560df44797ee0fa2721666c1078c2e65ec6a6fddb7baa8587bca6a411e6b = $this->env->getExtension("native_profiler");
        $__internal_ed11560df44797ee0fa2721666c1078c2e65ec6a6fddb7baa8587bca6a411e6b->enter($__internal_ed11560df44797ee0fa2721666c1078c2e65ec6a6fddb7baa8587bca6a411e6b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        
        $__internal_ed11560df44797ee0fa2721666c1078c2e65ec6a6fddb7baa8587bca6a411e6b->leave($__internal_ed11560df44797ee0fa2721666c1078c2e65ec6a6fddb7baa8587bca6a411e6b_prof);

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
