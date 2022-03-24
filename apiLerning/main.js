async function getPost(){
    let res = await fetch('https://jsonplaceholder.typicode.com/posts');
    let posts = await res.json();
    console.log(posts[0].title);
    posts.forEach((post) =>{
        document.querySelector('.post-list').innerHTML += `
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">${post.title}</h5>
                <p class="card-text">${post.body}</p>
            </div>
        </div>        
        `
    });
}
getPost();