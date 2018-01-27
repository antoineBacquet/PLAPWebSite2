<?php

/* template/base.html.twig */
class __TwigTemplate_59b55aac3d18856bf078845b3e7f6af3f6aedd8cc6a7fa0016611caf344dd5d2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'css' => array($this, 'block_css'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_3c6fb11f1e3928951bba6f523c59163e5c5978ae886aef6371db8162870b0dc3 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_3c6fb11f1e3928951bba6f523c59163e5c5978ae886aef6371db8162870b0dc3->enter($__internal_3c6fb11f1e3928951bba6f523c59163e5c5978ae886aef6371db8162870b0dc3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "template/base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
   <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">



    ";
        // line 9
        $this->displayBlock('css', $context, $blocks);
        // line 10
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("css/bootstrap.css"), "html", null, true);
        echo "\" />
    <link rel=\"stylesheet\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("css/starter-template.css"), "html", null, true);
        echo "\" />




    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">

    <title>Title</title>


</head>
<body>
    <nav class=\"navbar navbar-inverse navbar-fixed-top\">
        <div class=\"container\">

            ";
        // line 28
        echo twig_include($this->env, $context, "template/menutmp.html.twig");
        echo "

        </div>
    </nav>


    <div class=\"container\">
        <div class=\"starter-template\">
        ";
        // line 36
        $this->displayBlock('body', $context, $blocks);
        // line 37
        echo "        </div>
    </div>

    <script src=\"https://code.jquery.com/jquery-3.2.1.min.js\"></script>
    <script src=\"";
        // line 41
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("js/bootstrap.js"), "html", null, true);
        echo "\"></script>

    ";
        // line 43
        echo twig_include($this->env, $context, "template/_footer.html.twig");
        echo "
</body>
</html>
";
        
        $__internal_3c6fb11f1e3928951bba6f523c59163e5c5978ae886aef6371db8162870b0dc3->leave($__internal_3c6fb11f1e3928951bba6f523c59163e5c5978ae886aef6371db8162870b0dc3_prof);

    }

    // line 9
    public function block_css($context, array $blocks = array())
    {
        $__internal_e5a6942f5985cc833240b1c820612865f0d3965acf587233e56e7e888ee41d5b = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_e5a6942f5985cc833240b1c820612865f0d3965acf587233e56e7e888ee41d5b->enter($__internal_e5a6942f5985cc833240b1c820612865f0d3965acf587233e56e7e888ee41d5b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "css"));

        
        $__internal_e5a6942f5985cc833240b1c820612865f0d3965acf587233e56e7e888ee41d5b->leave($__internal_e5a6942f5985cc833240b1c820612865f0d3965acf587233e56e7e888ee41d5b_prof);

    }

    // line 36
    public function block_body($context, array $blocks = array())
    {
        $__internal_a1db8a107852b4edb2b143419a5c7d86d2342707de671a3210bc7e96ec5db4bf = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_a1db8a107852b4edb2b143419a5c7d86d2342707de671a3210bc7e96ec5db4bf->enter($__internal_a1db8a107852b4edb2b143419a5c7d86d2342707de671a3210bc7e96ec5db4bf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_a1db8a107852b4edb2b143419a5c7d86d2342707de671a3210bc7e96ec5db4bf->leave($__internal_a1db8a107852b4edb2b143419a5c7d86d2342707de671a3210bc7e96ec5db4bf_prof);

    }

    public function getTemplateName()
    {
        return "template/base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  108 => 36,  97 => 9,  86 => 43,  81 => 41,  75 => 37,  73 => 36,  62 => 28,  43 => 12,  39 => 11,  36 => 10,  34 => 9,  24 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
   <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">



    {% block css %}{% endblock %}

    <link rel=\"stylesheet\" href=\"{{ asset('css/bootstrap.css') }}\" />
    <link rel=\"stylesheet\" href=\"{{ asset('css/starter-template.css') }}\" />




    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">

    <title>Title</title>


</head>
<body>
    <nav class=\"navbar navbar-inverse navbar-fixed-top\">
        <div class=\"container\">

            {{ include('template/menutmp.html.twig') }}

        </div>
    </nav>


    <div class=\"container\">
        <div class=\"starter-template\">
        {% block body %}{% endblock %}
        </div>
    </div>

    <script src=\"https://code.jquery.com/jquery-3.2.1.min.js\"></script>
    <script src=\"{{ asset('js/bootstrap.js') }}\"></script>

    {{ include('template/_footer.html.twig') }}
</body>
</html>
", "template/base.html.twig", "/var/www/plap/app/Resources/views/template/base.html.twig");
    }
}
