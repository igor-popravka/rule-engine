# 🧠 RuleEngine

**Simple and extensible PHP Rules Engine** — define business rules as objects or callables and evaluate them against dynamic data ("facts").  
Designed for flexibility, readability, and runtime configurability.

---

## 📦 Installation

```bash
composer require igor-popravka/rule-engine
```

---

# 🚀 Quick Start

```php
use RuleEngine\RuleEngine;

$rules = new RuleEngine();

$rules->addRule(fn($cart) => count($cart->products) >= 3);
$rules->addRule(fn($cart) => $cart->getTotal() > 50);
$rules->addRule(fn($cart) => !empty(array_filter($cart->products, fn($p) => $p->name === 'Cheese')));

$cart = new Cart([
    new Product("Cheese", 10),
    new Product("Chips", 25),
]);

if ($rules->validateAny($cart)) {
    echo "✅ Discount can be applied!";
}
```

---

# 🧱 RuleEngine API

```php
final class Engine
{
    public function addRule(callable $rule): void;

    public function validateAny(mixed $fact): bool;

    public function validateAll(mixed $fact): bool;
}
```
- `addRule(callable $rule)`: Добавляет правило.
- `validateAny($fact)`: Возвращает true, если хотя бы одно правило прошло.
- `validateAll($fact)`: Возвращает true, только если все правила прошли.

---

🧩 Example Entities

```php
final class Product
{
    public function __construct(
        public string $name,
        public int $price
    ) {}
}

final class Cart
{
    public function __construct(
        public array $products = []
    ) {}

    public function getTotal(): int
    {
        return array_sum(array_map(fn($p) => $p->price, $this->products));
    }
}
```

---

# ✅ Benefits
- ✅ No hardcoded if chains
- ✅ Supports closures and invokable classes
- ✅ Easily testable
- ✅ Fully extensible and composable

---

# 📚 Inspired by

- Martin Fowler – Rules Engines
- Practical business logic abstraction for ecommerce, access control, workflows, etc.

---

# 📄 License

MIT © Igor Popravka