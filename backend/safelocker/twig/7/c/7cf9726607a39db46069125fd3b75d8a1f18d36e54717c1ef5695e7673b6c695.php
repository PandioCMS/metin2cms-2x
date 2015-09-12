<?php

/* index.html.twig */
class __TwigTemplate_7cf9726607a39db46069125fd3b75d8a1f18d36e54717c1ef5695e7673b6c695 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.html.twig", "index.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_f58e4cecbd43581198747b9d223deec18e3358db2155e8a993012ebf020f1042 = $this->env->getExtension("native_profiler");
        $__internal_f58e4cecbd43581198747b9d223deec18e3358db2155e8a993012ebf020f1042->enter($__internal_f58e4cecbd43581198747b9d223deec18e3358db2155e8a993012ebf020f1042_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_f58e4cecbd43581198747b9d223deec18e3358db2155e8a993012ebf020f1042->leave($__internal_f58e4cecbd43581198747b9d223deec18e3358db2155e8a993012ebf020f1042_prof);

    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        $__internal_a2becd63baec0b1503b6992a676495d20d857454ac5147b87ca43f0752b92886 = $this->env->getExtension("native_profiler");
        $__internal_a2becd63baec0b1503b6992a676495d20d857454ac5147b87ca43f0752b92886->enter($__internal_a2becd63baec0b1503b6992a676495d20d857454ac5147b87ca43f0752b92886_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 4
        echo "  Metin2CMS v2
";
        
        $__internal_a2becd63baec0b1503b6992a676495d20d857454ac5147b87ca43f0752b92886->leave($__internal_a2becd63baec0b1503b6992a676495d20d857454ac5147b87ca43f0752b92886_prof);

    }

    // line 7
    public function block_content($context, array $blocks = array())
    {
        $__internal_4d6cb98bfd0b2bdde3d7fa9fcb039a60a3dcf59ec3c347605c3278f52b969aa7 = $this->env->getExtension("native_profiler");
        $__internal_4d6cb98bfd0b2bdde3d7fa9fcb039a60a3dcf59ec3c347605c3278f52b969aa7->enter($__internal_4d6cb98bfd0b2bdde3d7fa9fcb039a60a3dcf59ec3c347605c3278f52b969aa7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 8
        echo "    Bine ai venit la Metin2CMS v2!
";
        
        $__internal_4d6cb98bfd0b2bdde3d7fa9fcb039a60a3dcf59ec3c347605c3278f52b969aa7->leave($__internal_4d6cb98bfd0b2bdde3d7fa9fcb039a60a3dcf59ec3c347605c3278f52b969aa7_prof);

    }

    public function getTemplateName()
    {
        return "index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 8,  49 => 7,  41 => 4,  35 => 3,  11 => 1,);
    }
}
