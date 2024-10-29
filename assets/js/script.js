const section__main = document.querySelector("#section__main");
const fieldset__login = document.querySelector(".fieldset__login");
const li__alterne = document.querySelectorAll(".li__alterne");
const section__registro = document.querySelector(".section__registro");
const section__login = document.querySelector(".section__login");

const opacity = (a, b) => {
    a.classList.toggle("opacity");
    b.classList.toggle("opacity");
};

const button__aluno = document.querySelector(".button__aluno");
const button__admin = document.querySelector(".button__admin");

const fazerLogin = (element) => {
    const form__login = document.querySelector(".form__login");
    if(form__login){
        form__login.addEventListener("submit", (event) => {
            event.preventDefault();
            
            const input__nome__login = document.querySelector("#input__nome__login");
            const input__email__login = document.querySelector("#input__email__login");   
            const input__senha__login = document.querySelector("#input__senha__login");
    
            const usuario = {  
                nome: input__nome__login.value,
                email: input__email__login.value,
                senha: input__senha__login.value
            };
    
            axios.post("./actions/api/login.php", {
                tabela: element,
                nome: usuario.nome,
                email: usuario.email,
                senha: usuario.senha
            }).then((response) => {
                const data = response.data;
                console.log(data);
                if(data.login){
                    axios.post("./actions/api/session.php", {
                        tabela: element,
                        nome: usuario.nome
                    }).then(response => {
                        const data = response.data;
                        if(data.session){
                            console.log(data.mensagem);
                            window.location.href = 'http://localhost/cursos/views/perfil.php';
                        } else {
                            console.error(data.mensagem);
                        }
                    }).catch(error => {
                        console.error("Erro ao gerenciar sessão:", error);
                    });
                }
            }).catch((error) => {
                console.error("Erro ao fazer login:", error);
            });
        });
    }
};

const fazerRegistro = (element) => {
    const form__registro = document.querySelector(".form__registro");
    if(form__registro){
        form__registro.addEventListener("submit", (event) => {
            event.preventDefault();
            
            const input__nome__registro = document.querySelector("#input__nome__registro");
            const input__email__registro = document.querySelector("#input__email__registro");   
            const input__senha__registro = document.querySelector("#input__senha__registro");
    
            const usuario = {  
                nome: input__nome__registro.value,
                email: input__email__registro.value,
                senha: input__senha__registro.value
            };
    
            axios.post("./actions/api/registro.php", {
                tabela: element,
                nome: usuario.nome,
                email: usuario.email,
                senha: usuario.senha
            }).then((response) => {
                const data = response.data;
                if(data.registro){
                    opacity(section__login,section__registro)
                }else{
                    console.log(data)
                }  // Isso exibirá o objeto com os valores preenchidos
            }).catch((error) => {
                console.error("Erro ao fazer registro:", error);
            });
        });
    }
};

// Inicia a lógica de login e registro
const iniciarLoginRegistro = (element) => {
    opacity(section__main, fieldset__login);
    fazerLogin(element);
    fazerRegistro(element);
};

button__admin.addEventListener("click", () => iniciarLoginRegistro("professores"));
button__aluno.addEventListener("click", () => iniciarLoginRegistro("alunos"));

// Corrigido para passar a função como referência
li__alterne.forEach(alterne => {
    alterne.addEventListener("click", () => opacity(section__login, section__registro));
});
