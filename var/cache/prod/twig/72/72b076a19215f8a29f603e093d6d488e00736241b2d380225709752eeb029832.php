<?php

/* @Twig/layout.html.twig */
class __TwigTemplate_815fe4d6b45713be8a12d564cdea92e3e6477522bad07f4cb07a1435483076c7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'head' => array($this, 'block_head'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_15f343e2239790a2f0b75ed3d0fd1f339f6147832520ec23f41bf09936d99f4b = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_15f343e2239790a2f0b75ed3d0fd1f339f6147832520ec23f41bf09936d99f4b->enter($__internal_15f343e2239790a2f0b75ed3d0fd1f339f6147832520ec23f41bf09936d99f4b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/layout.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getCharset(), "html", null, true);
        echo "\" />
        <meta name=\"robots\" content=\"noindex,nofollow\" />
        <meta name=\"viewport\" content=\"width=device-width,initial-scale=1\" />
        <title>";
        // line 7
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        <link rel=\"icon\" type=\"image/png\" href=\"";
        // line 8
        echo twig_include($this->env, $context, "@Twig/images/favicon.png.base64");
        echo "\">
        <style>";
        // line 9
        echo twig_include($this->env, $context, "@Twig/exception.css.twig");
        echo "</style>
        ";
        // line 10
        $this->displayBlock('head', $context, $blocks);
        // line 11
        echo "    </head>
    <body>
        <header>
            <div class=\"container\">
                <h1 class=\"logo\">";
        // line 15
        echo twig_include($this->env, $context, "@Twig/images/symfony-logo.svg");
        echo " Symfony Exception</h1>

                <div class=\"help-link\">
                    <a href=\"https://symfony.com/doc\">
                        <span class=\"icon\">";
        // line 19
        echo twig_include($this->env, $context, "@Twig/images/icon-book.svg");
        echo "</span>
                        <span class=\"hidden-xs-down\">Symfony</span> Docs
                    </a>
                </div>

                <div class=\"help-link\">
                    <a href=\"https://symfony.com/support\">
                        <span class=\"icon\">";
        // line 26
        echo twig_include($this->env, $context, "@Twig/images/icon-support.svg");
        echo "</span>
                        <span class=\"hidden-xs-down\">Symfony</span> Support
                    </a>
                </div>
            </div>
        </header>

        ";
        // line 33
        $this->displayBlock('body', $context, $blocks);
        // line 34
        echo "        ";
        echo twig_include($this->env, $context, "@Twig/base_js.html.twig");
        echo "
    </body>
</html>
";
        
        $__internal_15f343e2239790a2f0b75ed3d0fd1f339f6147832520ec23f41bf09936d99f4b->leave($__internal_15f343e2239790a2f0b75ed3d0fd1f339f6147832520ec23f41bf09936d99f4b_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_daedc2809b313a007a34c7e6f1b50e4fe267088cac4d0ba09e51ff48498c7d77 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_daedc2809b313a007a34c7e6f1b50e4fe267088cac4d0ba09e51ff48498c7d77->enter($__internal_daedc2809b313a007a34c7e6f1b50e4fe267088cac4d0ba09e51ff48498c7d77_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        
        $__internal_daedc2809b313a007a34c7e6f1b50e4fe267088cac4d0ba09e51ff48498c7d77->leave($__internal_daedc2809b313a007a34c7e6f1b50e4fe267088cac4d0ba09e51ff48498c7d77_prof);

    }

    // line 10
    public function block_head($context, array $blocks = array())
    {
        $__internal_ba94f85f32843f035638425cdf71d61f5d1e8625a1aff0921dbdca1cd5a6a7f8 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_ba94f85f32843f035638425cdf71d61f5d1e8625a1aff0921dbdca1cd5a6a7f8->enter($__internal_ba94f85f32843f035638425cdf71d61f5d1e8625a1aff0921dbdca1cd5a6a7f8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        
        $__internal_ba94f85f32843f035638425cdf71d61f5d1e8625a1aff0921dbdca1cd5a6a7f8->leave($__internal_ba94f85f32843f035638425cdf71d61f5d1e8625a1aff0921dbdca1cd5a6a7f8_prof);

    }

    // line 33
    public function block_body($context, array $blocks = array())
    {
        $__internal_965e254db4e523fc36e0135c9ae2864ba02d3b09d098ccb7ddcc3f87d763d56b = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_965e254db4e523fc36e0135c9ae2864ba02d3b09d098ccb7ddcc3f87d763d56b->enter($__internal_965e254db4e523fc36e0135c9ae2864ba02d3b09d098ccb7ddcc3f87d763d56b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_965e254db4e523fc36e0135c9ae2864ba02d3b09d098ccb7ddcc3f87d763d56b->leave($__internal_965e254db4e523fc36e0135c9ae2864ba02d3b09d098ccb7ddcc3f87d763d56b_prof);

    }

    public function getTemplateName()
    {
        return "@Twig/layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  119 => 33,  108 => 10,  97 => 7,  85 => 34,  83 => 33,  73 => 26,  63 => 19,  56 => 15,  50 => 11,  48 => 10,  44 => 9,  40 => 8,  36 => 7,  30 => 4,  25 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"{{ _charset }}\" />
        <meta name=\"robots\" content=\"noindex,nofollow\" />
        <meta name=\"viewport\" content=\"width=device-width,initial-scale=1\" />
        <title>{% block title %}{% endblock %}</title>
        <link rel=\"icon\" type=\"image/png\" href=\"{{ include('@Twig/images/favicon.png.base64') }}\">
        <style>{{ include('@Twig/exception.css.twig') }}</style>
        {% block head %}{% endblock %}
    </head>
    <body>
        <header>
            <div class=\"container\">
                <h1 class=\"logo\">{{ include('@Twig/images/symfony-logo.svg') }} Symfony Exception</h1>

                <div class=\"help-link\">
                    <a href=\"https://symfony.com/doc\">
                        <span class=\"icon\">{{ include('@Twig/images/icon-book.svg') }}</span>
                        <span class=\"hidden-xs-down\">Symfony</span> Docs
                    </a>
                </div>

                <div class=\"help-link\">
                    <a href=\"https://symfony.com/support\">
                        <span class=\"icon\">{{ include('@Twig/images/icon-support.svg') }}</span>
                        <span class=\"hidden-xs-down\">Symfony</span> Support
                    </a>
                </div>
            </div>
        </header>

        {% block body %}{% endblock %}
        {{ include('@Twig/base_js.html.twig') }}
    </body>
</html>
", "@Twig/layout.html.twig", "/var/www/plap/vendor/symfony/symfony/src/Symfony/Bundle/TwigBundle/Resources/views/layout.html.twig");
    }
}
