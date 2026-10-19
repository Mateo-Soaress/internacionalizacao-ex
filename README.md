# internacionalizacao-ex
Projeto exemplo para a funcionalidade de internacionalização, que permite múltiplos idiomas em um projeto Laravel.

Esse arquivo visa possibilitar a implementação, bem como explicar, a internacionalização de múltiplos idiomas no sistema.

Primeiramente, i18n (abreviação para "internationalization") no Laravel é uma dependência que facilita a utilização de diferentes idiomas e dialetos no sistema, como português brasileiro (pt_BR), inglês (en), espanhol (es), entre outros.
A tradução não é feita automaticamente, sendo necessário que o próprio desenvolvedor defina as traduções de cada texto do sistema.

- Definindo strings de tradução

Há duas maneiras de controlar as strings de tradução, ambas pertencendo à pasta lang. Por padrão, esse diretório é oculto no projeto, sendo necessário executar o seguinte comando no prompt de comando para o manusear: php artisan lang:publish.

A primeira maneira é utilizando arquivos php com arrays associativos:

/lang/pt_BR/messages.php

return [ </br>
    "welcome" => "Bem-vindo!",</br>
];

/lang/en/messages.php

return [</br>
    "welcome" => "Welcome!",</br>
];

Estes arquivos estarão em pastas separadas para cada língua, todas dentro da pasta lang, por exemplo:

/lang</br>
    ->/en</br>
        --->messages.php</br>
    ->/pt_BR</br>
        --->messages.php</br>
    ->/es</br>
        --->messages.php</br>

*Note que, para nomear esses diretórios, é necessário seguir o padrão ISO 15897, principalmente para línguar específicas de uma região, como inglês britânico (en_GB) e espanhol mexicano (es_MX).

A segunda maneira é utilizando arquivos json. Diferente de arquivos php, os arquivos json não precisam estar em pastas separadas, pois cada um deles representará um idioma:

/lang</br>
    ->en.json
    ->pt_BR.json
    ->es.json

Além disso, ao invés de utilizar chaves curtas, ele utiliza a própria frase como chave:

/lang/en.json

{</br>
    "Bem-vindo ao nosso sistema!": "Welcome to our system!",</br>
}

/lang/es.json

{</br>
    "Bem-vindo ao nosso sistema!": "Bienvenido a nuestro sistema!",</br>
}

Esse caso é mais utilizado para sistemas grandes e complexos, uma vez que se torna complicado criar chaves que remetam a uma frase em específico, ficando mais fácil localizar e manter manutenções das traduções.

- Definindo idioma padrão do sistema

O idioma padrão do sistema está presente em /config/app.php na variável de ambiente APP_LOCALE. Outra variável importante e a APP_FALLBACK_LOCALE, que será utilizada caso o local recebido não exista.

- Resgatando strings de tradução

Para resgatar as strings de tradução, podemos usar a função helper __() .
Se o sistema usa arquivos php, você deve passar o arquivo e a chave da tradução:

__('messages.welcome') // Retorna "Bem-vindo!" se o locale for pt_BR, e "Welcome!" se o locale for en.
Nesse caso, é necessário envolver a mensagem com duplo bigode, por exemplo:
<p>{{ __('messages.welcome') }}</p>

Em páginas blade, também é possível utilizar @lang:

@lang('messages.welcome')

*Se a chave e/ou a página de busca não for encontrada, o programa irá exibir a própria chave:

@lang('main.welcome') // Mostrará "main.welcome" na página, pois não há nenhum arquivo main.php.


- Parâmetros

É possível adicionar parâmetros nas strings de tradução, permitindo substituí-los por valores dinâmicos.
Para isso, é necessário definí-la na string de tradução com o símbolo de dois-pontos (:):

'welcome' => 'Bem-vindo, :name',

'Bem-vindo de volta, :name': 'Welcome back, :name'

Ao resgatar a string, para adicionar um valor ao parâmetro, você pode passar um array associativo como segundo parâmetro da função (seja ela @lang() ou __()):

@lang('welcome', ['name' => 'Junior'])
@lang('Bem-vindo de volta, :name', ['name' => 'Junior'])
__('welcome', ['name' => 'Junior'])
__('Bem-vindo de volta, :name', ['name' => 'Junior'])
// Retornam "Bem-vindo, Junior" ou "Welcome back, Junior"

Dependendo de como o parâmetro é definido (se a primeira letra for maiúscula, ou todas elas forem), o valor nele atribuído acompanhará o formato:

'welcome' => 'Bem-vindo, :Name'
@lang('welcome', ['name' => 'luciana']) // Retorna 'Bem-vindo, Luciana'

'welcome' => 'Bem-vindo, :NAME'
@lang('welcome', ['name' => 'luciana']) // Retorna 'Bem-vindo, LUCIANA'

- Pluralização

Existem duas formas de definir pluralidade.

A primeira irá alternar entre a forma singular e a de plural, tendo somente dois possíveis retornos. Para isso, basta separar os dois formatos com um |:

'coins' => 'Tem uma moeda|Tem muitas moedas'
'Tem uma moeda|Tem muitas moedas': 'There is one coin|There are a lot of coins'

A segunda forma permite mais flexibilidade, aceitando outras formas dependendo do valor recebido:

'coins' => '{0} Não há moedas|[1,10] Há algumas moedas|[11,*] Há muitas moedas'
'{0} Não há moedas|[1,10] Há algumas moedas|[11,*] Há muitas moedas': '{0} There is no coin|[1,10] There are a few coins|[11,*] There are a lot of coins'

Para resgatar uma string de tradução com pluralização, a função a ser utilizada é a trans_choice():

{{ trans_choice('coins', 1) }} // No primeiro caso, será retornado "Tem uma moeda"
{{ trans_choice('coins', 5) }} // No primeiro caso, será retornado "Tem muitas moedas"

{{ trans_choice('coins', 0) }} // No segunda caso, será retornado "Não há moedas"
{{ trans_choice('coins', 7) }} // No segunda caso, será retornado "Há algumas moedas"
{{ trans_choice('coins', 20) }} // No segunda caso, será retornado "Há muitas moedas"

Também é possível passar parâmetros com pluralização:

'time' => ':time minute ago|:time minutes ago'

{{ trans_choice('time', 1, ['time' => 1]) }} // Retorna "1 minute ago"

Se desejado, é possível exibir diretamente o valor numeral passado com o parâmetro padrão :count:

'time' => '{0} Now|{1} :count minute ago|[2,*] :count minutes ago'

{{ trans_choice('time', 5) }} // Retorna "5 minutes ago"

- Atualizando o idioma no sistema

Nas páginas do sistema, o usuário terá a possibilidade de escolher o idioma a ser exibido. Por padrão, o idioma será aquele configurado no /config/app.php.
Para isso, é possível criar uma rota get com um parâmetro:

Route::get('/locale/{lang}', [MainController::class, 'locale']);

Essa rota será chamada nas páginas, e o valor enviado no parâmetro representa o idioma escolhido, dentro do padrão ISO 15897 (o mesmo nome usado nas pastas/arquivos no diretório /lang):

href="/locale/pt_BR">Português BR

href="/locale/en">English

href="/locale/es">Español

No MainController, é criado um método que simplesmente atribui o valor à sessão (melhor forma para armazenar o idioma escolhido pelo usuário), e volta à página anterior:

public funcion locale($lang) {</br>
session(['locale' => $lang]);</br>
return redirect()->back();</br>
}

Por fim, para que o idioma seja efetivamente atualizado no sistema, cria-se um middleware, que podemos nomear de SetLocale. Esse middleware irá encobrir todas as rotas, para garantir que a troca de idioma possa ocorrer de qualquer parte do sistema. Ele terá a função de verificar se a sessão possui um local definido e, se tiver, atualiza a linguagem no App. Para implementá-lo, a melhor solução é colocar no arquivo /bootstrap/app.php:

return Application::configure(basePath: dirname(__DIR__)) </br>
    ->withRouting(
        web: __DIR__.'/../routes/web.php', 
        commands: __DIR__.'/../routes/console.php', 
        health: '/up',
    ) </br>
    ->withMiddleware(function (Middleware $middleware): void { </br>
        $middleware->web(append: [\App\Http\Middleware\SetLocale::class,]); // Linha adicionada para implementar o middleware às rotas do /routes/web.php</br>
    }) </br>
    ->withExceptions(function (Exceptions $exceptions): void { </br>
        // </br>
    })->create(); </br>

Função no middleware SetLocale:

public function handle(Request $request, Closure $next): Response </br>
{ </br>
    if (session()->has('locale')) { </br>
        App::setLocale(session('locale')); </br>
    } </br>

    return $next($request);
} </br>

- Referências

https://laravel.com/framework/docs/localization
