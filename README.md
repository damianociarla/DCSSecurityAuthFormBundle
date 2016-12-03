[![Build Status](https://travis-ci.org/damianociarla/DCSSecurityAuthFormBundle.svg?branch=master)](https://travis-ci.org/damianociarla/DCSSecurityAuthFormBundle) 
[![Coverage Status](https://coveralls.io/repos/github/damianociarla/DCSSecurityAuthFormBundle/badge.svg?branch=master)](https://coveralls.io/github/damianociarla/DCSSecurityAuthFormBundle?branch=master)

# DCSSecurityAuthFormBundle

This bundle provides a **login form** for the DCSSecurityCoreBundle.

The DCSSecurityAuthFormBundle uses the `dcs_security.core.authentication.provider` service to implement a custom security firewall called **dcs_form**.

## Installation

### Prerequisites

This bundle requires [DCSSecurityCoreBundle](https://github.com/damianociarla/DCSSecurityCoreBundle).

### Require the bundle

Run the following command:

	$ composer require dcs/security-auth-form-bundle "~1.0@dev"

Composer will install the bundle to your project's `vendor/dcs/security-auth-form-bundle` directory.

### Enable the bundle

Enable the bundle in the kernel:

	<?php
	// app/AppKernel.php

	public function registerBundles()
	{
		$bundles = array(
			// ...
			new DCS\Security\Auth\FormBundle\DCSSecurityAuthFormBundle(),
			// ...
		);
	}

### Configure your application's security.yml

In order for Symfony's security component to use the DCSSecurityAuthFormBundle, you must tell it to do so in the security.yml file. Below is a minimal example of the configuration necessary to use this bundle in your application:

    security:
        encoders:
            DCS\User\CoreBundle\Model\User: bcrypt

        role_hierarchy:
            ROLE_ADMIN: ROLE_USER

        providers:
            dcs_user:
                id: dcs_security.core.provider.user

        firewalls:
            main:
                pattern: ^/
                dcs_form:
                    provider: dcs_user
                    csrf_token_generator: security.csrf.token_manager
                    login_path: dcs_security_login
                    check_path: dcs_security_login_check
                logout:
                    path: dcs_security_logout
                    target: /
                anonymous: ~

        access_control:
            - { path: ^/login, roles: IS_AUTHENTICATED_ANONYMOUSLY }

# Reporting an issue or a feature request

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/damianociarla/DCSSecurityCoreBundle/issues).