/*
 * User clicks check box in parameter table to use project variables in combobox as function input
 **/
function variableSelectedFunctionParameterClicked(parameterCheckBox)
{
    updateClientEndOperationCounter();
    var comboCounter = 1;
    var flag = true;
    var counter = 0;
    var selected_feature_name = "";
    var selected_feature_value = "";
    //retrieving selected item name and value from natural language panel
    $("#changing_stmt a").each(function(){
        if($(this).attr("class") == "selected_expression")
        {
            $("input", $(this)).each(function () {
                selected_feature_name = $(this).attr("name");
                selected_feature_value = $(this).attr("value");
            });
        }
    });
    var allowed_var_value = "";
    var feature_parameter_list = new Array();
    var combo_parameter_counter = 0;
    var feature_parameter_list_counter = 0;
    //adding all variables of this project to the parameters of type combo
    if(parameterCheckBox.checked)
    {
        while(flag)
        {
            if(document.getElementById("customCombo"+comboCounter) != null)
            {
                //retrieving allowvar value of this parameter which type is combo
                allowed_var_value = "";
                for(feature_list_counter = 0; feature_list_counter<feature_list.length ; feature_list_counter++)
                {
                    if(feature_list[feature_list_counter].getOptions() == selected_feature_value && feature_list[feature_list_counter].getOptionsType() == selected_feature_name)
                    {
                        feature_parameter_list = feature_list[feature_list_counter].getParameterList();
                        combo_parameter_counter = 0;
                        feature_parameter_list_counter = 0;
                        for(feature_parameter_list_counter = 0 ; feature_parameter_list_counter < feature_parameter_list.length ; feature_parameter_list_counter++)
                        {
                            if(feature_parameter_list[feature_parameter_list_counter].getAllowedValues().length > 0)
                            {
                                combo_parameter_counter++;
                                if(combo_parameter_counter == comboCounter && feature_parameter_list[feature_parameter_list_counter].getType().toLowerCase() == "integer")
                                {
                                    allowed_var_value = feature_parameter_list[feature_parameter_list_counter].getAllowVar();                                    
                                }
                            }
                        }
                    }
                }
                //if allowvar is Yes then we are allowed to add project variable into combo parameter
                if(allowed_var_value.toLowerCase() == "yes")
                {
                    var id = "";
                    var title = "";
                    $("#parameters_table table tbody tr td select option").each(function(){
                        id = $(this).attr("id");
                        title = $(this).attr("title")
                    });
                    for(counter = 0 ; counter < project_variable_list.length ; counter++)
                    {
                        if(project_variable_list[counter].getVariableType() == "NUMBER")
                        {
                            var DropdownBox =document.getElementById("customCombo"+comboCounter);

                            DropdownBox.options[DropdownBox.options.length] = new Option(project_variable_list[counter].getVariableName(),'');
                            DropdownBox.options[DropdownBox.options.length-1].setAttribute("value", project_variable_list[counter].getVariableName());
                            DropdownBox.options[DropdownBox.options.length-1].setAttribute("id", id);
                            DropdownBox.options[DropdownBox.options.length-1].setAttribute("title", title);                        
                        }
                    }
                }               
                comboCounter++;
            }
            else
            {
                flag = false;
            }
        }
    }
    //removing all variables of this project from parameters of type combo    
    else
    {
        while(flag)
        {
            if(document.getElementById("customCombo"+comboCounter) != null)
            {
                //retrieving allowvar value of this parameter which type is combo
                allowed_var_value = "";
                for(feature_list_counter = 0; feature_list_counter<feature_list.length ; feature_list_counter++)
                {
                    if(feature_list[feature_list_counter].getOptions() == selected_feature_value && feature_list[feature_list_counter].getOptionsType() == selected_feature_name)
                    {
                        feature_parameter_list = feature_list[feature_list_counter].getParameterList();
                        combo_parameter_counter = 0;
                        feature_parameter_list_counter = 0;
                        for(feature_parameter_list_counter = 0 ; feature_parameter_list_counter < feature_parameter_list.length ; feature_parameter_list_counter++)
                        {
                            if(feature_parameter_list[feature_parameter_list_counter].getAllowedValues().length > 0)
                            {
                                combo_parameter_counter++;
                                if(combo_parameter_counter == comboCounter && feature_parameter_list[feature_parameter_list_counter].getType().toLowerCase() == "integer")
                                {
                                    allowed_var_value = feature_parameter_list[feature_parameter_list_counter].getAllowVar();                                    
                                }
                            }
                        }
                    }
                }
                //if allowvar is Yes then we are allowed to removed project variable from combo parameter                
                if(allowed_var_value.toLowerCase() == "yes")
                {
                    for(counter = 0 ; counter < project_variable_list.length ; counter++)
                    {
                        if(project_variable_list[counter].getVariableType() == "NUMBER")
                        {
                            document.getElementById("customCombo"+comboCounter).options.length = document.getElementById("customCombo"+comboCounter).options.length - 1;
                        }
                    } 
                }                               
                comboCounter++;}
            else
            {
                flag = false;
            }
        }
    }
}



