<?php

/* profile/service.html.twig */
class __TwigTemplate_9895e8ed8cd44a595839cb17368d33c25c55fc1e444fe271fa9299052f2bca40 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("template/base.html.twig", "profile/service.html.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "template/base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_f94de03fb0ec2091147c04dd944e716807305c4f8ec444fd82608dfa644ed150 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_f94de03fb0ec2091147c04dd944e716807305c4f8ec444fd82608dfa644ed150->enter($__internal_f94de03fb0ec2091147c04dd944e716807305c4f8ec444fd82608dfa644ed150_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "profile/service.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_f94de03fb0ec2091147c04dd944e716807305c4f8ec444fd82608dfa644ed150->leave($__internal_f94de03fb0ec2091147c04dd944e716807305c4f8ec444fd82608dfa644ed150_prof);

    }

    // line 4
    public function block_body($context, array $blocks = array())
    {
        $__internal_f2c068ccacc4941fa17a71f6386139ead751ac451616c86dfec9715098d697f0 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_f2c068ccacc4941fa17a71f6386139ead751ac451616c86dfec9715098d697f0->enter($__internal_f2c068ccacc4941fa17a71f6386139ead751ac451616c86dfec9715098d697f0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 5
        echo "<div class=\"jumbotron main-w\">
    <h3> Liste des services</h3>


    <a href=\"";
        // line 9
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("discordjoin");
        echo "\" >Rejoindre le serveur Discord</a> <br><br>


    ";
        // line 12
        if ((twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new Twig_Error_Runtime('Variable "user" does not exist.', 12, $this->getSourceContext()); })()), "discordId", array()) == null)) {
            // line 13
            echo "        <li>Focntionnement : Cliquez sur l'invitation discord ci-dessu.</li>
        <li>Une fois sur le discord envoyer un message privé au bot avec le code suivant :</li>
        <hr class=\"my-4\">
        ";
            // line 16
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new Twig_Error_Runtime('Variable "user" does not exist.', 16, $this->getSourceContext()); })()), "discordRandomString", array()), "html", null, true);
            echo "
    ";
        } else {
            // line 18
            echo "        Liaison avec le discord effectuer <br>

        <a href=\"";
            // line 20
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("updatemyroles");
            echo "\" > Mettre a jour mes roles discord</a> <br> <br>

        <button class=\"btn btn-default\" onclick=\"testDiscord()\" > Tester le discord</button>
    ";
        }
        // line 24
        echo "    <script>

        function testDiscord() {

            \$.ajax({
                url: '";
        // line 29
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("testdiscord");
        echo "',
                type: \"POST\",
                dataType: \"json\",
                data: {
                    test : true
                },
                //async: true,
                success: function (data) {
                    if(data['error']){
                        alert(JSON.stringify(data));
                    }



                    }
                }).fail(function (msg) {
                    alert('error');
                });
            }


</script>
</div>
";
        
        $__internal_f2c068ccacc4941fa17a71f6386139ead751ac451616c86dfec9715098d697f0->leave($__internal_f2c068ccacc4941fa17a71f6386139ead751ac451616c86dfec9715098d697f0_prof);

    }

    public function getTemplateName()
    {
        return "profile/service.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  82 => 29,  75 => 24,  68 => 20,  64 => 18,  59 => 16,  54 => 13,  52 => 12,  46 => 9,  40 => 5,  34 => 4,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'template/base.html.twig' %}


{% block body %}
<div class=\"jumbotron main-w\">
    <h3> Liste des services</h3>


    <a href=\"{{ path('discordjoin') }}\" >Rejoindre le serveur Discord</a> <br><br>


    {%  if user.discordId == null %}
        <li>Focntionnement : Cliquez sur l'invitation discord ci-dessu.</li>
        <li>Une fois sur le discord envoyer un message privé au bot avec le code suivant :</li>
        <hr class=\"my-4\">
        {{ user.discordRandomString }}
    {% else %}
        Liaison avec le discord effectuer <br>

        <a href=\"{{ path('updatemyroles') }}\" > Mettre a jour mes roles discord</a> <br> <br>

        <button class=\"btn btn-default\" onclick=\"testDiscord()\" > Tester le discord</button>
    {% endif %}
    <script>

        function testDiscord() {

            \$.ajax({
                url: '{{ (path('testdiscord')) }}',
                type: \"POST\",
                dataType: \"json\",
                data: {
                    test : true
                },
                //async: true,
                success: function (data) {
                    if(data['error']){
                        alert(JSON.stringify(data));
                    }



                    }
                }).fail(function (msg) {
                    alert('error');
                });
            }


</script>
</div>
{% endblock %}", "profile/service.html.twig", "/var/www/plap/app/Resources/views/profile/service.html.twig");
    }
}
