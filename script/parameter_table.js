/*
 * User clicks check box in parameter table to use project variables in combobox as function input
 **/
function variableSelectedFunctionParameterClicked(parameterCheckBox)
{
    updateClientEndOperationCounter();
    var comboCounter = 1;
    var flag = true;
    var counter = 0;
    //adding all variables of this project to the parameters of type combo
    if(parameterCheckBox.checked)
    {
        while(flag)
        {
            if(document.getElementById("customCombo"+comboCounter) != null)
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
                comboCounter++;}
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
                for(counter = 0 ; counter < project_variable_list.length ; counter++)
                {
                    if(project_variable_list[counter].getVariableType() == "NUMBER")
                    {
                        document.getElementById("customCombo"+comboCounter).options.length = document.getElementById("customCombo"+comboCounter).options.length - 1;
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



