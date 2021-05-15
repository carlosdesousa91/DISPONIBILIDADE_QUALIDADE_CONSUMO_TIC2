# DISPONIBILIDADE_QUALIDADE_CONSUMO_TIC2

### Arquivo _access.php deve ser criado para incluir as credencias

```
<?php
        $access_client_id = ''; // Registered App ApplicationID

        $access_username = ''; // for example john.doe@yourdomain.com
    
        $access_password = ''; // Azure password for above user

?>
```

##### referencias:

https://docs.microsoft.com/en-us/javascript/api/overview/powerbi/refresh-token

https://www.youtube.com/watch?v=dL-0-ezd84w&ab_channel=LeonardoKarpinski-PowerBIMaster

https://www.msbiblog.com/2018/01/12/power-bi-embedded-example-using-curl-and-php/

##### playground

###### instalar Login-PowerBI

- é necessário instalar o login power bi para gerar o token pelo powershell

``` Install-Module -Name MicrosoftPowerBIMgmt -Scope CurrentUser ```

https://powerbi.microsoft.com/en-us/blog/working-with-powershell-in-power-bi/

- gerar token para play ground

```
$url = "https://api.powerbi.com/v1.0/myorg/groups/6b98c748-3362-47e1-bc29-b6e586e8c279/reports/fd741e17-0583-483e-94b5-1bf94b7fa74f/GenerateToken"
$body = "{'accessLeval': 'View'}"
$response = Invoke-PowerBIRestMethod -Url $url -Body $body -Method Post
$response
$json = $response | ConvertFrom-Json
$json.token
```

###### desativar segurança de dois fatores(se necessário)

https://docs.microsoft.com/pt-br/microsoft-365/admin/security-and-compliance/set-up-multi-factor-authentication?view=o365-worldwide