document.addEventListener("wheel", function(){
    if (document.activeElement.type === "number"){
        document.activeElement.blur();
    }
});
