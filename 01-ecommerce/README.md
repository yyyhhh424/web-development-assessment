# E-commerce Entity Relationship Diagram (v2)

```mermaid
erDiagram
    CUSTOMERS ||--o{ ADDRESSES : has
    CUSTOMERS ||--o{ ORDERS : places
    CUSTOMERS ||--o{ REVIEWS : writes
    CUSTOMERS ||--o| CARTS : owns
    CUSTOMERS ||--o{ WISHLISTS : saves
    CATEGORIES ||--o{ CATEGORIES : parent_of
    CATEGORIES ||--o{ PRODUCTS : contains
    PRODUCTS ||--o{ PRODUCT_IMAGES : has
    PRODUCTS ||--o{ PRODUCT_VARIANTS : has
    PRODUCTS ||--o{ ORDER_ITEMS : appears_in
    PRODUCTS ||--o{ CART_ITEMS : appears_in
    PRODUCTS ||--o{ REVIEWS : receives
    PRODUCTS ||--o{ WISHLISTS : saved_in
    PRODUCTS }o--o{ TAGS : tagged_with
    PRODUCT_VARIANTS ||--o{ ORDER_ITEMS : chosen_as
    PRODUCT_VARIANTS ||--o{ CART_ITEMS : chosen_as
    CARTS ||--|{ CART_ITEMS : contains
    ORDERS ||--|{ ORDER_ITEMS : contains
    ORDERS ||--o{ PAYMENTS : has
    ORDERS ||--o| SHIPMENTS : has
    ORDERS ||--o{ ORDER_STATUS_HISTORY : logs
    ORDERS }o--o| COUPONS : redeems
    ADDRESSES ||--o{ ORDERS : ships_to
    ADDRESSES ||--o{ ORDERS : bills_to
    PAYMENTS ||--o{ REFUNDS : has

    CUSTOMERS {
        int id PK
        varchar name
        varchar email 
        varchar password_hash
        varchar phone
        timestamp created_at
        timestamp updated_at
    }

    ADDRESSES {
        int id PK
        int customer_id FK
        varchar recipient_name
        varchar line1
        varchar line2
        varchar city
        varchar state
        varchar postcode
        varchar country
        boolean is_default
    }

    CATEGORIES {
        int id PK
        int parent_id FK
        varchar name
        varchar slug 
        text description
    }

    PRODUCTS {
        int id PK
        int category_id FK
        varchar sku 
        varchar name
        text description
        double price
        int stock_quantity
        boolean is_active
        timestamp created_at
        timestamp updated_at
    }

    PRODUCT_IMAGES {
        int id PK
        int product_id FK
        varchar image_url
        int sort_order
        boolean is_primary
    }

    PRODUCT_VARIANTS {
        int id PK
        int product_id FK
        varchar sku 
        varchar variant_name
        decimal price_adjustment
        int stock_quantity
    }

    TAGS {
        int id PK
        varchar name
        varchar slug 
    }

    PRODUCT_TAGS {
        int product_id FK
        int tag_id FK
    }

    CARTS {
        int id PK
        int customer_id FK
        timestamp created_at
        timestamp updated_at
    }

    CART_ITEMS {
        int id PK
        int cart_id FK
        int product_id FK
        int variant_id FK
        int quantity
        timestamp added_at
    }

    WISHLISTS {
        int id PK
        int customer_id FK
        int product_id FK
        timestamp added_at
    }

    COUPONS {
        int id PK
        varchar code 
        varchar description
        varchar discount_type
        decimal discount_value
        decimal min_order_amount
        timestamp starts_at
        timestamp expires_at
        int usage_limit
        int times_used
    }

    ORDERS {
        int id PK
        int customer_id FK
        int shipping_address_id FK
        int billing_address_id FK
        int coupon_id FK
        varchar order_number 
        varchar status
        double subtotal
        double shipping_fee
        double tax_amount
        double discount_amount
        double total_amount
        timestamp ordered_at
    }

    ORDER_ITEMS {
        int id PK
        int order_id FK
        int product_id FK
        int variant_id FK
        varchar product_name
        double unit_price
        int quantity
        double line_total
    }

    ORDER_STATUS_HISTORY {
        int id PK
        int order_id FK
        varchar status
        varchar note
        timestamp changed_at
    }

    PAYMENTS {
        int id PK
        int order_id FK
        varchar provider
        varchar transaction_reference UK
        double amount
        varchar status
        timestamp paid_at
    }

    REFUNDS {
        int id PK
        int payment_id FK
        double amount
        varchar reason
        varchar status
        timestamp refunded_at
    }

    SHIPMENTS {
        int id PK
        int order_id FK
        varchar courier
        varchar tracking_number
        varchar status
        timestamp shipped_at
        timestamp delivered_at
    }

    REVIEWS {
        int id PK
        int customer_id FK
        int product_id FK
        int rating
        varchar title
        text comment
        timestamp created_at
    }
```

## Relationship summary

- One customer can have many addresses, orders, reviews, and wishlist entries, and owns at most one active cart.
- One category can contain many products and can optionally have a parent category.
- One product can have many images, variants, tags, and reviews.
- A cart or an order holds one or more line items; each line item can optionally point to a specific product variant.
- Products and orders (and products and carts) form many-to-many relationships through their respective item tables.
- An order references two addresses (shipping and billing), can optionally redeem one coupon, and logs every status change it goes through.
- An order can have multiple payment attempts, zero or one shipment, and each payment can have multiple refunds.
