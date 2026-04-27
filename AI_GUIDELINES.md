# AI Assistant Guidelines for brdd-php

When generating code or making edits in this repository, you MUST follow these standards:

1. **Strict Types**: Always declare `declare(strict_types=1);` at the top of every PHP file.
2. **Generics emulation**: PHP does not natively support Generics. You must use PHPDoc tags (`@template`, `@param T`, `@return T`) to define generic constraints in interfaces and classes.
3. **Immutability when possible**: Context classes (`ValidationContext`, `ExecutionContext`) should be strictly built via static `build()` methods to discourage invalid instantiation states.
4. **Service Contracts**:
   - `ValidateService` MUST return `ValidationContext` and NEVER fetch data.
   - `EnrichService` MUST NOT contain business rules or validations.
   - `UseCase` MUST return `ExecutionContext` and NEVER run `if/else` business rules directly.

Always ensure PHPUnit tests are updated whenever modifying contexts or core interfaces.
