jQuery(function() 
{ 
    toggleInputElementsByProductType($('#productType').val());

    $('#productType').on('change', function() 
    {
        console.log("Select option changed.");

        toggleInputElementsByProductType($(this).val());
    });

})

function toggleInputElementsByProductType($productTypeName)
{
    console.log("Selected product type is: " + $productTypeName);

    $('#productType').children("option").each( function() 
    {
        console.log("Child Option: " + $(this).val());

        $('#' + $(this).val()).toggle($(this).is(':selected'));
    });
}