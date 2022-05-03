<?php

define('SITE_ROOT', __DIR__);
define('SITE', ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . (!empty($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ''));
define('DIR_IMAGE', SITE_ROOT . '/public/storage/');
define('SETTING', '
{
    "introInfo": {
        "title": "Добро Пожаловать!",
        "subtitle": "Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.",
        "button": "Пройти опрос",
        "img": "https://upgrade2.dealer-car.ru/image/data/16478426423382119.jpg"
     },
    "formInfo": {
        "title": "Заполните заявку",
        "stage": "Заявка",
        "buttonText": "Отправить",
        "successMsg": "Заявка успешно отправлена",
        "errorMsg": "Ошибка при отправке",
        "img": "https://www.meme-arsenal.com/memes/5687aef33dc529fdc43fd7c5dcc8aef0.jpg",
        "fieldWidth": "260px",
        "fields": [
            {
                "labelText": "Ваше имя",
                "type": "text",
                "required": true,
                "minlength": 2,
                "maxlength": 30,
                "name": "name",
                "col": 8
            },
            {
                "labelText": "Номер телефона",
                "type": "text",
                "required": true,
                "minlength": 18,
                "name": "phone",
                "mask": "+7 (###) ###-##-##",
                "placeholder": "+7"
            }
        ]
    },
    "openInfo": {
        "type": "circle",
        "settings": {
            "closed": false,
            "contentSize": {
                "mobile": {
                    "maxWidth": "768px",
                    "padding": "15px 20px 5px"
                },
                "tablet": {
                    "maxWidth": "768px",
                    "padding": "15px 20px 5px"
                },
                "desktop": {
                    "maxWidth": "1260px",
                    "padding": "5px 40px"
                },
                "notebook": {
                    "maxWidth": "1260px",
                    "padding": "5px 40px"
                }
            },
            "size": {
                "mobile": {
                    "width": "100px",
                    "height": "100px"
                },
                "tablet": {
                    "width": "100px",
                    "height": "100px"
                },
                "desktop": {
                    "width": "100px",
                    "height": "100px"
                },
                "notebook": {
                    "width": "100px",
                    "height": "100px"
                }
            },
            "text": "Супер-пупер предложение. Строка 1",
            "btnText": "Открыть",
            "color": "#ffffff",
            "position": {
                "mobile": {
                    "top": "unset",
                    "left": "unset",
                    "right": "50px",
                    "bottom": "50px"
                },
                "tablet": {
                    "top": "unset",
                    "left": "unset",
                    "right": "50px",
                    "bottom": "50px"
                },
                "desktop": {
                    "top": "unset",
                    "left": "unset",
                    "right": "150px",
                    "bottom": "50px"
                },
                "notebook": {
                    "top": "unset",
                    "left": "unset",
                    "right": "150px",
                    "bottom": "50px"
                }
            },
            "background": "#EC0000"
        }
    },
    "socials": {
        "text": "Свяжитесь с нами",
        "whats": "#",
        "teleg": "#",
        "viber": "#"
    },
    "widgetInfo": {
        "colorBtnText": "#FFFFFF",
        "colorMain": "#4C5CE3",
        "colorMainHover": "#2333a8",
        "colorSecondary": "#F5F7F9",
        "borderRadiusButton": "6px",
        "borderRadiusMain": "16px",
        "borderRadiusSecondary": "4px",
        "defaultImgQuestion": "https://static.autox.com/uploads/2020/08/hyundai-elantra-n-line.jpg"
    }
}
');
