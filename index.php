<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AJAX: Sign Up Page</title>

        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script>
        
            function validateForm() 
            {
                return false;
            }
            
        </script>
        
        <script>
            
            $(document).ready( function()
            {
                
                
                $("#username").change(function()
                {
                    //alert(  $("#username").val() );
                    $.ajax(
                        {
                            type: "GET",
                            url: "checkUsername.php",
                            dataType: "json",
                            data: 
                            { 
                                "username": $("#username").val() 
                                
                            },
                            success: function(data,status) 
                            {
                                //alert(data.password);
                                
                                if (!data) 
                                {  //data == false
                                    $("#unavailable").html("<h4> Username is available</h4>");
                                    $("#unavailable").css("color","green");                                
                                } 
                                
                                else 
                                {
                                    $("#unavailable").html("<h4> Username is not available</h4>");
                                    $("#unavailable").css("color","red");
                                }
                        
                            },
                            complete: function(data,status) //optional, used for debugging purposes
                            { 
                                //alert(status);
                            }
                        });//ajax
                });

                
                $("#same").change(function()
                {
                    var first = $("password").val();
                    var second = $("same").val();
                    
                    if(first == second)
                    {
                        //alert("passwords match");
                        $("#passwordErr").html("passwords match");
                        $("#passwordErr").css("color","green");
                    }
                    else
                    {
                        //alert("passwords do not match");
                        $("#passwordErr").html("passwords don't match");
                        $("#passwordErr").css("color","red");
                    }
                });
                
                $("#state").change(function() 
                {
                    //alert($("#state").val());
                    
                    $.ajax(
                        {

                            type: "GET",
                            url: "http://itcdland.csumb.edu/~milara/ajax/countyList.php",
                            dataType: "json",
                            data: { "state": $("#state").val()},
                            success: function(data,status) {
                              
                            //   alert(data[0].county);
                            $("#county").html("<option> - Select One -</option>");
                            for(var i = 0; i < data.length; i++)
                            {
                                 $("#county").append("<option>" + data[i].county + "</option>");
                            }
                            
                            },
                            complete: function(data,status) //optional, used for debugging purposes
                            {
                                //alert(status);
                            }
                    
                    });//ajax
                    
                    
                    
                });
                
                $("#zipCode").change( function()
                {
                    $.ajax({

                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/cityInfoByZip.php",
                        dataType: "json",
                        data: { "zip": $("#zipCode").val()   },
                        success: function(data,status) {
                          
                          if(!data){
                                $("#zipMSG").html("Zip-Code not found!");
                                $("#zipMSG").css("color", "red");
                                $("#city").html("");
                                $("#latitude").html("");
                                $("#longitude").html("");
                            }
                            else
                            {
                                $("#zipMSG").html("");
                                $("#city").html(data.city);
                                $("#lat").html(data.latitude);
                                $("#long").html(data.longitude);
                            }
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                        
                        
                    });//ajax
                } );
                
            }   ); //documentReady
            
            
            
        </script>

    </head>

    <body>
    
       <h1> Sign Up Form </h1>
    
        <form onsubmit="return validateForm()">
            <fieldset>
               <legend>Sign Up</legend>
                First Name:  <input id = "first_name" type="text"><br> 
                Last Name:   <input id = "last_name" type="text"><br> 
                Email:       <input id = "email" type="text"><br> 
                Phone Number:<input id = "phone" type="text"><br><br>
                Zip Code:    <input type="text" id="zipCode"><br>
                City:        <span id="city"></span>
                <br>
                Latitude: 
                <br>
                Longitude:
                <br><br>
                State: 
                <select id="state">
                    <option value="">Select One</option>
                    <option value="ca"> California</option>
                    <option value="ny"> New York</option>
                    <option value="tx"> Texas</option>
                    <option value="va"> Virginia</option>
                </select><br />
                
                Select a County: <select id="county"></select><br>
                
                Desired Username: <input type="text" id = "username"><br>
                
                Password: <input id = "password" type="password"><br>
                
                Type Password Again: <input id = "same"  type="password"><br>
                <span id = "passwordErr"></span><br>
                
                <input type="submit" value="Sign up!">
                <br />
            </fieldset>
        </form>
      
    </body>
</html>