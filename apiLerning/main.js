async function getPosts(){
    let res = await fetch('http://rp-32/apishka/api1/posts');
    let posts = await res.json();
    document.querySelector('.post-list').innerHTML = '';
    posts.forEach((post) =>{
        document.querySelector('.post-list').innerHTML += `
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">${post.title}</h5>
                <p class="card-text">${post.body}</p>
            </div>
        </div>        
        `
    })
}
async function addPost(){
    const title = document.getElementById('title').value,
        body = document.getElementById('body').value;

    let formData = new FormData();
    formData.append('title',title);
    formData.append('body', body);

    const res = await fetch('http://rp-32/apishka/api1/posts',{
        method: 'POST',
        body: formData
    });
    const data = await res.json();
    console.log(data);
}
getPosts();