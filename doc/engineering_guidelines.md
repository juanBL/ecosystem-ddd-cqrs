### 🤖 Engineering Guidelines

## Engineering philosophy

### History

### 🎯 Hexagonal Architecture

This repository follows the Hexagonal Architecture pattern. Also, it's structured using `modules`.

### Command Bus
There is 1 implementation of the [command bus](../src/Shared/Domain/Bus/Command/CommandBus.php).
1. [Sync](../src/Shared/Infrastructure/Bus/Command/InMemorySymfonyCommandBus.php) using the Symfony Message Bus

### Query Bus
There is 1 implementation of the [query bus](../src/Shared/Domain/Bus/Query/QueryBus.php).
The [Query Bus](../src/Shared/Infrastructure/Bus/Query/InMemorySymfonyQueryBus.php) uses the Symfony Message Bus.

### Event Bus
The [Event Bus](../src/Shared/Infrastructure/Bus/Event/InMemory/InMemorySymfonyEventBus.php) uses the Symfony Message Bus.

### 📱 Monitoring

## Patterns to follow

- List patterns that engineers should follow here.

#### Repository pattern

#### Commits

Follow this rule: https://www.conventionalcommits.org/en/v1.0.0/