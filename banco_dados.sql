PGDMP                 
        y            mercado    9.4.26    9.4.26 C               0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false                        2615    16601    vendas    SCHEMA        CREATE SCHEMA vendas;
    DROP SCHEMA vendas;
             postgres    false            ?            1259    16744    percentual_imposto    TABLE       CREATE TABLE vendas.percentual_imposto (
    id_percentual_imposto integer NOT NULL,
    id_tipo_produto integer NOT NULL,
    nr_valor_imposto numeric NOT NULL,
    dt_cadastro timestamp with time zone NOT NULL,
    dt_desativacao timestamp with time zone
);
 &   DROP TABLE vendas.percentual_imposto;
       vendas         postgres    false    7                       0    0 /   COLUMN percentual_imposto.id_percentual_imposto    COMMENT     i   COMMENT ON COLUMN vendas.percentual_imposto.id_percentual_imposto IS 'Identificador percentual_imposto';
            vendas       postgres    false    180                       0    0 )   COLUMN percentual_imposto.id_tipo_produto    COMMENT     ]   COMMENT ON COLUMN vendas.percentual_imposto.id_tipo_produto IS 'Identificador tipo_produto';
            vendas       postgres    false    180                       0    0 *   COLUMN percentual_imposto.nr_valor_imposto    COMMENT     _   COMMENT ON COLUMN vendas.percentual_imposto.nr_valor_imposto IS 'Valor percentual do Imposto';
            vendas       postgres    false    180                       0    0 %   COLUMN percentual_imposto.dt_cadastro    COMMENT     Z   COMMENT ON COLUMN vendas.percentual_imposto.dt_cadastro IS 'Data de cadastro de imposto';
            vendas       postgres    false    180                       0    0 (   COLUMN percentual_imposto.dt_desativacao    COMMENT     b   COMMENT ON COLUMN vendas.percentual_imposto.dt_desativacao IS 'Data de desativação do imposto';
            vendas       postgres    false    180            ?            1259    16742 ,   percentual_imposto_id_percentual_imposto_seq    SEQUENCE     ?   CREATE SEQUENCE vendas.percentual_imposto_id_percentual_imposto_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 C   DROP SEQUENCE vendas.percentual_imposto_id_percentual_imposto_seq;
       vendas       postgres    false    7    180            	           0    0 ,   percentual_imposto_id_percentual_imposto_seq    SEQUENCE OWNED BY     }   ALTER SEQUENCE vendas.percentual_imposto_id_percentual_imposto_seq OWNED BY vendas.percentual_imposto.id_percentual_imposto;
            vendas       postgres    false    179            ?            1259    16864    produto    TABLE     J  CREATE TABLE vendas.produto (
    id_produto integer NOT NULL,
    cd_produto character(50) NOT NULL,
    id_tipo_produto integer NOT NULL,
    nm_produto character varying(150) NOT NULL,
    nr_valor numeric(16,2) NOT NULL,
    ds_produto text,
    fl_ativo character(1) NOT NULL,
    dt_cadastro time with time zone NOT NULL
);
    DROP TABLE vendas.produto;
       vendas         postgres    false    7            
           0    0    COLUMN produto.id_produto    COMMENT     R   COMMENT ON COLUMN vendas.produto.id_produto IS 'Identificador da tabela Produto';
            vendas       postgres    false    182                       0    0    COLUMN produto.cd_produto    COMMENT     E   COMMENT ON COLUMN vendas.produto.cd_produto IS 'Código do Produto';
            vendas       postgres    false    182                       0    0    COLUMN produto.id_tipo_produto    COMMENT     n   COMMENT ON COLUMN vendas.produto.id_tipo_produto IS 'Identificador da tabela tipo_produto | Tipo do Produto';
            vendas       postgres    false    182                       0    0    COLUMN produto.nm_produto    COMMENT     B   COMMENT ON COLUMN vendas.produto.nm_produto IS 'Nome do Produto';
            vendas       postgres    false    182                       0    0    COLUMN produto.nr_valor    COMMENT     A   COMMENT ON COLUMN vendas.produto.nr_valor IS 'Valor do Produto';
            vendas       postgres    false    182                       0    0    COLUMN produto.ds_produto    COMMENT     I   COMMENT ON COLUMN vendas.produto.ds_produto IS 'Descrição do produto';
            vendas       postgres    false    182                       0    0    COLUMN produto.fl_ativo    COMMENT     F   COMMENT ON COLUMN vendas.produto.fl_ativo IS 'Situação do produto';
            vendas       postgres    false    182                       0    0    COLUMN produto.dt_cadastro    COMMENT     D   COMMENT ON COLUMN vendas.produto.dt_cadastro IS 'Data de Cadastro';
            vendas       postgres    false    182            ?            1259    16862    produto_id_produto_seq    SEQUENCE        CREATE SEQUENCE vendas.produto_id_produto_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE vendas.produto_id_produto_seq;
       vendas       postgres    false    7    182                       0    0    produto_id_produto_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE vendas.produto_id_produto_seq OWNED BY vendas.produto.id_produto;
            vendas       postgres    false    181            ?            1259    16736    tipo_produto    TABLE     x   CREATE TABLE vendas.tipo_produto (
    id_tipo_produto integer NOT NULL,
    nm_tipo_produto character(100) NOT NULL
);
     DROP TABLE vendas.tipo_produto;
       vendas         postgres    false    7                       0    0 #   COLUMN tipo_produto.id_tipo_produto    COMMENT     Z   COMMENT ON COLUMN vendas.tipo_produto.id_tipo_produto IS 'Identificador do tipo Produto';
            vendas       postgres    false    178                       0    0 #   COLUMN tipo_produto.nm_tipo_produto    COMMENT     T   COMMENT ON COLUMN vendas.tipo_produto.nm_tipo_produto IS 'Nome do tipo do produto';
            vendas       postgres    false    178            ?            1259    16734     tipo_produto_id_tipo_produto_seq    SEQUENCE     ?   CREATE SEQUENCE vendas.tipo_produto_id_tipo_produto_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE vendas.tipo_produto_id_tipo_produto_seq;
       vendas       postgres    false    7    178                       0    0     tipo_produto_id_tipo_produto_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE vendas.tipo_produto_id_tipo_produto_seq OWNED BY vendas.tipo_produto.id_tipo_produto;
            vendas       postgres    false    177            ?            1259    16646    venda    TABLE     ?   CREATE TABLE vendas.venda (
    id_venda integer NOT NULL,
    nr_valor_venda numeric(16,2) NOT NULL,
    dt_cadastro timestamp with time zone NOT NULL
);
    DROP TABLE vendas.venda;
       vendas         postgres    false    7                       0    0    COLUMN venda.id_venda    COMMENT     E   COMMENT ON COLUMN vendas.venda.id_venda IS 'Identificador da Venda';
            vendas       postgres    false    174                       0    0    COLUMN venda.nr_valor_venda    COMMENT     C   COMMENT ON COLUMN vendas.venda.nr_valor_venda IS 'Valor da Venda';
            vendas       postgres    false    174                       0    0    COLUMN venda.dt_cadastro    COMMENT     ?   COMMENT ON COLUMN vendas.venda.dt_cadastro IS 'Data da Venda';
            vendas       postgres    false    174            ?            1259    16644    venda_id_venda_seq    SEQUENCE     {   CREATE SEQUENCE vendas.venda_id_venda_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE vendas.venda_id_venda_seq;
       vendas       postgres    false    174    7                       0    0    venda_id_venda_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE vendas.venda_id_venda_seq OWNED BY vendas.venda.id_venda;
            vendas       postgres    false    173            ?            1259    16655 
   venda_item    TABLE       CREATE TABLE vendas.venda_item (
    id_venda_item integer NOT NULL,
    id_venda integer NOT NULL,
    id_produto integer NOT NULL,
    nr_valor numeric NOT NULL,
    nr_quantidade numeric(16,2) NOT NULL,
    dt_cadastro timestamp with time zone NOT NULL
);
    DROP TABLE vendas.venda_item;
       vendas         postgres    false    7                       0    0    COLUMN venda_item.id_venda_item    COMMENT     Q   COMMENT ON COLUMN vendas.venda_item.id_venda_item IS 'Identificador Venda Item';
            vendas       postgres    false    176                       0    0    COLUMN venda_item.id_venda    COMMENT     J   COMMENT ON COLUMN vendas.venda_item.id_venda IS 'Identificador da Venda';
            vendas       postgres    false    176                       0    0    COLUMN venda_item.id_produto    COMMENT     N   COMMENT ON COLUMN vendas.venda_item.id_produto IS 'Identificador do produto';
            vendas       postgres    false    176                       0    0    COLUMN venda_item.nr_valor    COMMENT     M   COMMENT ON COLUMN vendas.venda_item.nr_valor IS 'Valor de venda do produto';
            vendas       postgres    false    176                       0    0    COLUMN venda_item.nr_quantidade    COMMENT     W   COMMENT ON COLUMN vendas.venda_item.nr_quantidade IS 'Quantidade de produto por item';
            vendas       postgres    false    176                       0    0    COLUMN venda_item.dt_cadastro    COMMENT     G   COMMENT ON COLUMN vendas.venda_item.dt_cadastro IS 'Data de Cadastro';
            vendas       postgres    false    176            ?            1259    16653    venda_item_id_venda_item_seq    SEQUENCE     ?   CREATE SEQUENCE vendas.venda_item_id_venda_item_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE vendas.venda_item_id_venda_item_seq;
       vendas       postgres    false    176    7                        0    0    venda_item_id_venda_item_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE vendas.venda_item_id_venda_item_seq OWNED BY vendas.venda_item.id_venda_item;
            vendas       postgres    false    175            w           2604    16747    id_percentual_imposto    DEFAULT     ?   ALTER TABLE ONLY vendas.percentual_imposto ALTER COLUMN id_percentual_imposto SET DEFAULT nextval('vendas.percentual_imposto_id_percentual_imposto_seq'::regclass);
 W   ALTER TABLE vendas.percentual_imposto ALTER COLUMN id_percentual_imposto DROP DEFAULT;
       vendas       postgres    false    179    180    180            x           2604    16867 
   id_produto    DEFAULT     x   ALTER TABLE ONLY vendas.produto ALTER COLUMN id_produto SET DEFAULT nextval('vendas.produto_id_produto_seq'::regclass);
 A   ALTER TABLE vendas.produto ALTER COLUMN id_produto DROP DEFAULT;
       vendas       postgres    false    182    181    182            v           2604    16739    id_tipo_produto    DEFAULT     ?   ALTER TABLE ONLY vendas.tipo_produto ALTER COLUMN id_tipo_produto SET DEFAULT nextval('vendas.tipo_produto_id_tipo_produto_seq'::regclass);
 K   ALTER TABLE vendas.tipo_produto ALTER COLUMN id_tipo_produto DROP DEFAULT;
       vendas       postgres    false    177    178    178            t           2604    16649    id_venda    DEFAULT     p   ALTER TABLE ONLY vendas.venda ALTER COLUMN id_venda SET DEFAULT nextval('vendas.venda_id_venda_seq'::regclass);
 =   ALTER TABLE vendas.venda ALTER COLUMN id_venda DROP DEFAULT;
       vendas       postgres    false    173    174    174            u           2604    16658    id_venda_item    DEFAULT     ?   ALTER TABLE ONLY vendas.venda_item ALTER COLUMN id_venda_item SET DEFAULT nextval('vendas.venda_item_id_venda_item_seq'::regclass);
 G   ALTER TABLE vendas.venda_item ALTER COLUMN id_venda_item DROP DEFAULT;
       vendas       postgres    false    176    175    176            ?          0    16744    percentual_imposto 
   TABLE DATA               ?   COPY vendas.percentual_imposto (id_percentual_imposto, id_tipo_produto, nr_valor_imposto, dt_cadastro, dt_desativacao) FROM stdin;
    vendas       postgres    false    180   IH       !           0    0 ,   percentual_imposto_id_percentual_imposto_seq    SEQUENCE SET     [   SELECT pg_catalog.setval('vendas.percentual_imposto_id_percentual_imposto_seq', 17, true);
            vendas       postgres    false    179            ?          0    16864    produto 
   TABLE DATA               ?   COPY vendas.produto (id_produto, cd_produto, id_tipo_produto, nm_produto, nr_valor, ds_produto, fl_ativo, dt_cadastro) FROM stdin;
    vendas       postgres    false    182   ?H       "           0    0    produto_id_produto_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('vendas.produto_id_produto_seq', 4, true);
            vendas       postgres    false    181            ?          0    16736    tipo_produto 
   TABLE DATA               H   COPY vendas.tipo_produto (id_tipo_produto, nm_tipo_produto) FROM stdin;
    vendas       postgres    false    178   BI       #           0    0     tipo_produto_id_tipo_produto_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('vendas.tipo_produto_id_tipo_produto_seq', 53, true);
            vendas       postgres    false    177            ?          0    16646    venda 
   TABLE DATA               F   COPY vendas.venda (id_venda, nr_valor_venda, dt_cadastro) FROM stdin;
    vendas       postgres    false    174   ?I       $           0    0    venda_id_venda_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('vendas.venda_id_venda_seq', 8, true);
            vendas       postgres    false    173            ?          0    16655 
   venda_item 
   TABLE DATA               o   COPY vendas.venda_item (id_venda_item, id_venda, id_produto, nr_valor, nr_quantidade, dt_cadastro) FROM stdin;
    vendas       postgres    false    176   ?I       %           0    0    venda_item_id_venda_item_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('vendas.venda_item_id_venda_item_seq', 12, true);
            vendas       postgres    false    175            ?           2606    16872    pk_id_produto 
   CONSTRAINT     [   ALTER TABLE ONLY vendas.produto
    ADD CONSTRAINT pk_id_produto PRIMARY KEY (id_produto);
 ?   ALTER TABLE ONLY vendas.produto DROP CONSTRAINT pk_id_produto;
       vendas         postgres    false    182    182            ?           2606    16752    pk_percentual_imposto 
   CONSTRAINT     y   ALTER TABLE ONLY vendas.percentual_imposto
    ADD CONSTRAINT pk_percentual_imposto PRIMARY KEY (id_percentual_imposto);
 R   ALTER TABLE ONLY vendas.percentual_imposto DROP CONSTRAINT pk_percentual_imposto;
       vendas         postgres    false    180    180            ~           2606    16741    pk_tipo_produto 
   CONSTRAINT     g   ALTER TABLE ONLY vendas.tipo_produto
    ADD CONSTRAINT pk_tipo_produto PRIMARY KEY (id_tipo_produto);
 F   ALTER TABLE ONLY vendas.tipo_produto DROP CONSTRAINT pk_tipo_produto;
       vendas         postgres    false    178    178            z           2606    16651    pk_venda 
   CONSTRAINT     R   ALTER TABLE ONLY vendas.venda
    ADD CONSTRAINT pk_venda PRIMARY KEY (id_venda);
 8   ALTER TABLE ONLY vendas.venda DROP CONSTRAINT pk_venda;
       vendas         postgres    false    174    174            |           2606    16663    pk_venda_item 
   CONSTRAINT     a   ALTER TABLE ONLY vendas.venda_item
    ADD CONSTRAINT pk_venda_item PRIMARY KEY (id_venda_item);
 B   ALTER TABLE ONLY vendas.venda_item DROP CONSTRAINT pk_venda_item;
       vendas         postgres    false    176    176            ?           2606    16764    uk_nm_tipo_produto 
   CONSTRAINT     e   ALTER TABLE ONLY vendas.tipo_produto
    ADD CONSTRAINT uk_nm_tipo_produto UNIQUE (nm_tipo_produto);
 I   ALTER TABLE ONLY vendas.tipo_produto DROP CONSTRAINT uk_nm_tipo_produto;
       vendas         postgres    false    178    178            ?           2606    16873    fk_produto_tipo_produto    FK CONSTRAINT     ?   ALTER TABLE ONLY vendas.produto
    ADD CONSTRAINT fk_produto_tipo_produto FOREIGN KEY (id_tipo_produto) REFERENCES vendas.tipo_produto(id_tipo_produto);
 I   ALTER TABLE ONLY vendas.produto DROP CONSTRAINT fk_produto_tipo_produto;
       vendas       postgres    false    1918    178    182            ?           2606    16890    fk_tipo_imposto    FK CONSTRAINT     ?   ALTER TABLE ONLY vendas.percentual_imposto
    ADD CONSTRAINT fk_tipo_imposto FOREIGN KEY (id_tipo_produto) REFERENCES vendas.tipo_produto(id_tipo_produto) ON UPDATE CASCADE ON DELETE CASCADE;
 L   ALTER TABLE ONLY vendas.percentual_imposto DROP CONSTRAINT fk_tipo_imposto;
       vendas       postgres    false    180    1918    178            ?           2606    16885    fk_venda_venda_item    FK CONSTRAINT     ?   ALTER TABLE ONLY vendas.venda_item
    ADD CONSTRAINT fk_venda_venda_item FOREIGN KEY (id_venda) REFERENCES vendas.venda(id_venda) ON UPDATE CASCADE ON DELETE CASCADE;
 H   ALTER TABLE ONLY vendas.venda_item DROP CONSTRAINT fk_venda_venda_item;
       vendas       postgres    false    1914    176    174            ?   M   x?eʱ?0?ڞ?ⓜ?2d?9h????2??%?j?,ruEj??/?i?鿄??w?	F???0cV>s???K??      ?   ?   x??α?0?????6??am7????0c4???????????`?,n	
?8?^1a??;b???
?az????S?$X??????@???????w???h??s??[?l??`?E??????O??k??$4?      ?   <   x?35???K?/?=??$39Q?V??Ԑ3(?? ??fV@?1?tN?9?<1%??Vq??qqq [0      ?   >   x?u?A?0?wPQ0?A????ѩ??{???e? 芩?hV?2"!uI?Ʋ7?O?D?;8      ?   K   x?m˱?@D????cv?;9j??:??????ep??p?A@{u.s?@(]??9?[???Ʋ????T?)?c     