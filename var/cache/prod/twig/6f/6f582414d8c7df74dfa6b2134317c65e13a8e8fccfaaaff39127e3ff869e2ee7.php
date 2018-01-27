<?php

/* command/add.html.twig */
class __TwigTemplate_f50edb2e9a4c09ca036e0cb447ef2084188ac9550da145114cf0a5ec9d0db93f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("template/base.html.twig", "command/add.html.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
            'css' => array($this, 'block_css'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "template/base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_53560402f1e74bc0c792fbd31c3f16e9b4d8435fc1c1d619ac5fdcfe6ae7dbe6 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_53560402f1e74bc0c792fbd31c3f16e9b4d8435fc1c1d619ac5fdcfe6ae7dbe6->enter($__internal_53560402f1e74bc0c792fbd31c3f16e9b4d8435fc1c1d619ac5fdcfe6ae7dbe6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "command/add.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_53560402f1e74bc0c792fbd31c3f16e9b4d8435fc1c1d619ac5fdcfe6ae7dbe6->leave($__internal_53560402f1e74bc0c792fbd31c3f16e9b4d8435fc1c1d619ac5fdcfe6ae7dbe6_prof);

    }

    // line 4
    public function block_body($context, array $blocks = array())
    {
        $__internal_21646953f150f9fbd68ec985a607660208e0cf9d8a3be6f3eb0a6e3ac5704404 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_21646953f150f9fbd68ec985a607660208e0cf9d8a3be6f3eb0a6e3ac5704404->enter($__internal_21646953f150f9fbd68ec985a607660208e0cf9d8a3be6f3eb0a6e3ac5704404_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 5
        echo "
    ";
        // line 6
        $this->displayBlock('css', $context, $blocks);
        // line 9
        echo "
<div class=\"jumbotron main-w\">
    <h3> Ajouter une commande</h3>

    <input id=\"search\" type=\"text\" name=\"search\" placeholder=\"Search..\" autocomplete=\"off\" onkeyup=\"search(this)\" class=\"auto-suggest\"
           onfocus=\"document.getElementById('searchresultlist').style.cssText = 'display:block;'\"
           onblur=\"document.getElementById('searchresultlist').style.cssText = 'display:none;'\">
    <ul style=\"display: none\" id=\"searchresultlist\" class=\"suggestions\"></ul>


    ";
        // line 19
        echo         $this->env->getRuntime('Symfony\Bridge\Twig\Form\TwigRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new Twig_Error_Runtime('Variable "form" does not exist.', 19, $this->getSourceContext()); })()), 'form_start');
        echo "


    <h2> Liste des items de la commande</h2>

    <div class=\"table-responsive\">
        <table class=\"table table-striped\" id=\"items-table\">
            <thead>
            <tr> <th> Item </th> <th> Quantité </th>  <th> Action </th> </tr>
            </thead>
                <tbody>

                </tbody>
        </table>
    </div>
    ";
        // line 34
        echo $this->env->getRuntime('Symfony\Bridge\Twig\Form\TwigRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new Twig_Error_Runtime('Variable "form" does not exist.', 34, $this->getSourceContext()); })()), "important", array()), 'row');
        echo "

    ";
        // line 36
        echo $this->env->getRuntime('Symfony\Bridge\Twig\Form\TwigRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new Twig_Error_Runtime('Variable "form" does not exist.', 36, $this->getSourceContext()); })()), "save", array()), 'row');
        echo "

    ";
        // line 38
        echo $this->env->getRuntime('Symfony\Bridge\Twig\Form\TwigRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new Twig_Error_Runtime('Variable "form" does not exist.', 38, $this->getSourceContext()); })()), "items", array()), 'widget');
        echo "

    ";
        // line 40
        echo $this->env->getRuntime('Symfony\Bridge\Twig\Form\TwigRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->getSourceContext(), (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new Twig_Error_Runtime('Variable "form" does not exist.', 40, $this->getSourceContext()); })()), "quantity", array()), 'widget');
        echo "

    ";
        // line 42
        echo         $this->env->getRuntime('Symfony\Bridge\Twig\Form\TwigRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new Twig_Error_Runtime('Variable "form" does not exist.', 42, $this->getSourceContext()); })()), 'form_end');
        echo "





    <script>

        var dataSave;

        var itemAdded = [];

        function search(input) {
            //alert(input.value);
            if(input.value === \"\" || input.value === undefined){
                var list = document.getElementById('searchresultlist');
                list.innerHTML = '';
            }
            else{
                \$.ajax({
                    url: '";
        // line 62
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("searchitemajax");
        echo "',
                    type: \"POST\",
                    dataType: \"json\",
                    data: {
                        text : input.value
                    },
                    //async: true,
                    success: function (data) {
                        //alert(JSON.stringify(data));
                        dataSave = data;
                        var list = document.getElementById('searchresultlist');

                        var option = '';
                        for (var i = 0; i < data.results.length; i++) {
                            option += '<li onmousedown=addItem(' + i + ')>' + data.results[i].name + '</li>';

                        }
                        list.innerHTML = option;
                        //alert(option);

                    }
                }).fail(function (msg) {
                    alert('error');
                });
            }

        }


        function addItem(i){
            if(itemAdded[dataSave.results[i].id] === undefined){
                itemAdded[dataSave.results[i].id] = [];

                itemAdded[dataSave.results[i].id]['data'] = dataSave.results[i];
                itemAdded[dataSave.results[i].id]['quantity'] = 1;

                var list = document.getElementById('searchresultlist');
                list.innerHTML = '';

                var search = document.getElementById('search');
                search.value = '';

                //alert('lel');
            }
            updateItemAddedList();
        }

        function removeItem(id){
            if(itemAdded[id] !== undefined){
                delete itemAdded[id];
                //alert('lel');
            }
            updateItemAddedList();
        }

        function updateItemAddedList(){


            //---------------------------------------------
            var table = document.getElementById(\"items-table\");
            while(table.rows.length > 0) {
                table.deleteRow(0);
            }

            for (var id in itemAdded) {
                var row = table.insertRow(0);

                var cellItem = row.insertCell(0);
                var cellQuantity = row.insertCell(1);
                var cellAction = row.insertCell(2);

                cellItem.innerHTML = itemAdded[id]['data'].name +  '<input type=\"hidden\" id=\"form_items_' + id + '\" name=\"form[items][]\" value=\"' + id + '\" >';
                cellQuantity.innerHTML =  '<input type=\"number\" id=\"form_quantity_' + id + '\" name=\"form[quantity][]\" value=\"' + itemAdded[id]['quantity'] + '\" onkeyup=\"changeItemQuantitySaved(' + id + ')\" onmouseup=\"changeItemQuantitySaved(' + id + ')\">';
                cellAction.innerHTML = ' <a href=\"javascript:removeItem(' + id + ')\"> remove </a>'



            }
        }

        function changeItemQuantitySaved(id){
            if(itemAdded[id] !== undefined){
                itemAdded[id]['quantity'] = document.getElementById('form_quantity_' + id).value;
            }
        }



    </script>

</div>
";
        
        $__internal_21646953f150f9fbd68ec985a607660208e0cf9d8a3be6f3eb0a6e3ac5704404->leave($__internal_21646953f150f9fbd68ec985a607660208e0cf9d8a3be6f3eb0a6e3ac5704404_prof);

    }

    // line 6
    public function block_css($context, array $blocks = array())
    {
        $__internal_027f25814834a95053dc6340d8da3629d41e2443c2fe61198fb18ee98e153a39 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_027f25814834a95053dc6340d8da3629d41e2443c2fe61198fb18ee98e153a39->enter($__internal_027f25814834a95053dc6340d8da3629d41e2443c2fe61198fb18ee98e153a39_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "css"));

        // line 7
        echo "        <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("css/auto-suggest.css"), "html", null, true);
        echo "\" />
    ";
        
        $__internal_027f25814834a95053dc6340d8da3629d41e2443c2fe61198fb18ee98e153a39->leave($__internal_027f25814834a95053dc6340d8da3629d41e2443c2fe61198fb18ee98e153a39_prof);

    }

    public function getTemplateName()
    {
        return "command/add.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  224 => 7,  218 => 6,  119 => 62,  96 => 42,  91 => 40,  86 => 38,  81 => 36,  76 => 34,  58 => 19,  46 => 9,  44 => 6,  41 => 5,  35 => 4,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'template/base.html.twig' %}


{% block body %}

    {% block css %}
        <link rel=\"stylesheet\" href=\"{{ asset('css/auto-suggest.css') }}\" />
    {%  endblock %}

<div class=\"jumbotron main-w\">
    <h3> Ajouter une commande</h3>

    <input id=\"search\" type=\"text\" name=\"search\" placeholder=\"Search..\" autocomplete=\"off\" onkeyup=\"search(this)\" class=\"auto-suggest\"
           onfocus=\"document.getElementById('searchresultlist').style.cssText = 'display:block;'\"
           onblur=\"document.getElementById('searchresultlist').style.cssText = 'display:none;'\">
    <ul style=\"display: none\" id=\"searchresultlist\" class=\"suggestions\"></ul>


    {{ form_start(form) }}


    <h2> Liste des items de la commande</h2>

    <div class=\"table-responsive\">
        <table class=\"table table-striped\" id=\"items-table\">
            <thead>
            <tr> <th> Item </th> <th> Quantité </th>  <th> Action </th> </tr>
            </thead>
                <tbody>

                </tbody>
        </table>
    </div>
    {{ form_row(form.important) }}

    {{ form_row(form.save) }}

    {{ form_widget(form.items) }}

    {{ form_widget(form.quantity) }}

    {{ form_end(form) }}





    <script>

        var dataSave;

        var itemAdded = [];

        function search(input) {
            //alert(input.value);
            if(input.value === \"\" || input.value === undefined){
                var list = document.getElementById('searchresultlist');
                list.innerHTML = '';
            }
            else{
                \$.ajax({
                    url: '{{ (path('searchitemajax')) }}',
                    type: \"POST\",
                    dataType: \"json\",
                    data: {
                        text : input.value
                    },
                    //async: true,
                    success: function (data) {
                        //alert(JSON.stringify(data));
                        dataSave = data;
                        var list = document.getElementById('searchresultlist');

                        var option = '';
                        for (var i = 0; i < data.results.length; i++) {
                            option += '<li onmousedown=addItem(' + i + ')>' + data.results[i].name + '</li>';

                        }
                        list.innerHTML = option;
                        //alert(option);

                    }
                }).fail(function (msg) {
                    alert('error');
                });
            }

        }


        function addItem(i){
            if(itemAdded[dataSave.results[i].id] === undefined){
                itemAdded[dataSave.results[i].id] = [];

                itemAdded[dataSave.results[i].id]['data'] = dataSave.results[i];
                itemAdded[dataSave.results[i].id]['quantity'] = 1;

                var list = document.getElementById('searchresultlist');
                list.innerHTML = '';

                var search = document.getElementById('search');
                search.value = '';

                //alert('lel');
            }
            updateItemAddedList();
        }

        function removeItem(id){
            if(itemAdded[id] !== undefined){
                delete itemAdded[id];
                //alert('lel');
            }
            updateItemAddedList();
        }

        function updateItemAddedList(){


            //---------------------------------------------
            var table = document.getElementById(\"items-table\");
            while(table.rows.length > 0) {
                table.deleteRow(0);
            }

            for (var id in itemAdded) {
                var row = table.insertRow(0);

                var cellItem = row.insertCell(0);
                var cellQuantity = row.insertCell(1);
                var cellAction = row.insertCell(2);

                cellItem.innerHTML = itemAdded[id]['data'].name +  '<input type=\"hidden\" id=\"form_items_' + id + '\" name=\"form[items][]\" value=\"' + id + '\" >';
                cellQuantity.innerHTML =  '<input type=\"number\" id=\"form_quantity_' + id + '\" name=\"form[quantity][]\" value=\"' + itemAdded[id]['quantity'] + '\" onkeyup=\"changeItemQuantitySaved(' + id + ')\" onmouseup=\"changeItemQuantitySaved(' + id + ')\">';
                cellAction.innerHTML = ' <a href=\"javascript:removeItem(' + id + ')\"> remove </a>'



            }
        }

        function changeItemQuantitySaved(id){
            if(itemAdded[id] !== undefined){
                itemAdded[id]['quantity'] = document.getElementById('form_quantity_' + id).value;
            }
        }



    </script>

</div>
{% endblock %}", "command/add.html.twig", "/var/www/plap/app/Resources/views/command/add.html.twig");
    }
}
