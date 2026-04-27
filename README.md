# 🐘 BRDD PHP

[![Packagist Version](https://img.shields.io/packagist/v/brdd/brdd-php?label=packagist)](https://packagist.org/packages/brdd/brdd-php)

This repository contains the official **Business Rule Driven Design (BRDD)** interfaces and contexts tailored for PHP 8.1+. It enforces strict architectural boundaries, ensuring that orchestrators, validation engines, and side effects remain decoupled.

## 🚀 Installation

```bash
composer require brdd/brdd-php
```

## 🛠 Basic Usage Example

```php
use Brdd\Contracts\UseCase;
use Brdd\Contexts\ExecutionContext;

class SubmitAssignmentUseCase implements UseCase {
    // Inject services via constructor...

    public function execute($input): ExecutionContext {
        $enrichedData = $this->enrichService->enrich($input);
        $validationContext = $this->validateService->validate($enrichedData);
        
        $context = ExecutionContext::build("US_SUBMIT", $validationContext);

        if ($validationContext->hasErrors()) {
            return $context;
        }

        $result = $this->businessService->execute($enrichedData);
        
        $context->addSetter('SET_ID', $result->id);
        
        $context->addEffect(ExecutionContext::POST_EFFECT, 'EFF_NOTIFY', function() use ($result) {
            $this->clientService->call($result);
        });

        $context->setData($result);
        return $context;
    }
}
```

## 🤖 AI-First Development
Check the [AI Guidelines](./AI_GUIDELINES.md) for more details.

## 📚 Documentation
- [Technical Spec](https://github.com/brdd-design/brdd/blob/main/BRDD.md)
- [Practical Example](https://github.com/brdd-design/brdd/blob/main/core/articles/EN/BRDD-PRACTICAL-EXAMPLE.md)

## 📄 License
MIT
