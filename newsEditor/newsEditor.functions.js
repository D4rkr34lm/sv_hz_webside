function saveArticle(){
    const title = $("#article_header").text();
    const content = $("#article_content").text();
    let id;
    
    let params = (new URL(window.location.href)).searchParams;
    
    if(params.get("id") === "new"){
        id = -1;
    }
    else{
        id = params.get("id");
    }

    const data = {ID: id, Title: title, Content: content};

    console.log(JSON.stringify(data));  

    $.post("newsEditor\\savingHandler.php", data)
}