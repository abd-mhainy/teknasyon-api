create table devices
(
    id          bigint unsigned auto_increment
        primary key,
    uId         varchar(255) not null,
    appId       varchar(255) not null,
    language    varchar(255) not null,
    os          varchar(255) not null,
    status      varchar(255) not null,
    clientToken varchar(255) not null,
    created_at  timestamp    null,
    updated_at  timestamp    null,
    constraint clientToken_uindex
        unique (clientToken)
)
    collate = utf8mb4_unicode_ci;

create table failed_jobs
(
    id         bigint unsigned auto_increment
        primary key,
    connection text                                not null,
    queue      text                                not null,
    payload    longtext                            not null,
    exception  longtext                            not null,
    failed_at  timestamp default CURRENT_TIMESTAMP not null
)
    collate = utf8mb4_unicode_ci;

create table migrations
(
    id        int unsigned auto_increment
        primary key,
    migration varchar(255) not null,
    batch     int          not null
)
    collate = utf8mb4_unicode_ci;

create table purchases
(
    id          bigint unsigned auto_increment
        primary key,
    deviceId    int                                 not null,
    receipt     varchar(255)                        not null,
    clientToken varchar(255)                        not null,
    expireDate  timestamp default CURRENT_TIMESTAMP not null on update CURRENT_TIMESTAMP,
    created_at  timestamp                           null,
    updated_at  timestamp                           null
)
    collate = utf8mb4_unicode_ci;

create table settings
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(255) not null,
    value      varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null
)
    collate = utf8mb4_unicode_ci;
