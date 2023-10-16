# Routes

| url | Verb HTTP | Controller | Method | constraint | comment |
|---|---|---|---|---|---|
| / | GET | Front\Main | home | | frontoffice homepage |







________________


## FrontOffice

| url | Verb HTTP | Controller | Method | constraint | comment |
|---|---|---|---|---|---|
| / | GET | Front\Main | home | | frontoffice homepage |
| /movie/list | GET | Front\Movie | list | | |
| /movie/{id} | GET | Front\Movie | show | id = \d+ | |
| /movie/{id}/review/add | GET | Front\Movie | addReview | id = \d+ | display the form |
| /movie/{id}/review/add | POST | Front\Movie | addReview | id = \d+ | manage the form |

## BackOffice

| url | Verb HTTP | Controller | Method | constraint | comment |
|---|---|---|---|---|---|
| /back/ | GET | Back\Main | home | | backoffice homepage |
| /back/movie/ | GET | Back\Movie | browse | | movie browse |
| /back/movie/{id} | GET | Back\Movie | read | id = \d+ | movie read |
| /back/movie/{id}/edit | GET | Back\Movie | edit | id = \d+ | movie edit : display form |
| /back/movie/{id}/edit | POST | Back\Movie | edit | id = \d+ | movie edit : manage form |
| /back/movie/add | GET | Back\Movie | add | | movie add : display form |
| /back/movie/add | POST | Back\Movie | add | | movie add : manage form |
| /back/movie/{id}/delete | GET | Back\Movie | delete | id = \d+ | movie delete |
| /back/season/ | GET | Back\Season | browse | | season browse |
| /back/season/{id} | GET | Back\Season | read | id = \d+ | season read |
| /back/season/{id}/edit | GET | Back\Season | edit | id = \d+ | season edit : display form |
| /back/season/{id}/edit | POST | Back\Season | edit | id = \d+ | season edit : manage form |
| /back/season/add | GET | Back\Season | add | | season add : display form |
| /back/season/add | POST | Back\Season | add | | season add : manage form |
| /back/season/{id}/delete | GET | Back\Season | delete | id = \d+ | season delete |
| /back/casting/ | GET | Back\Casting | browse | | casting browse |
| /back/casting/{id} | GET | Back\Casting | read | id = \d+ | casting read |
| /back/casting/{id}/edit | GET | Back\Casting | edit | id = \d+ | casting edit : display form |
| /back/casting/{id}/edit | POST | Back\Casting | edit | id = \d+ | casting edit : manage form |
| /back/casting/add | GET | Back\Casting | add | | casting add : display form |
| /back/casting/add | POST | Back\Casting | add | | casting add : manage form |
| /back/casting/{id}/delete | GET | Back\Casting | delete | id = \d+ | casting delete |
