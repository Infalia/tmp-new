--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.6
-- Dumped by pg_dump version 9.6.6

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: association_images; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE association_images (
    id integer NOT NULL,
    association_id integer NOT NULL,
    name character varying(255) NOT NULL,
    url character varying(255) NOT NULL,
    size character varying(255) NOT NULL,
    updated_at timestamp(0) without time zone DEFAULT ('now'::text)::timestamp(0) with time zone NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE association_images OWNER TO wgn_tmp2;

--
-- Name: association_images_id_seq; Type: SEQUENCE; Schema: public; Owner: wgn_tmp2
--

CREATE SEQUENCE association_images_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE association_images_id_seq OWNER TO wgn_tmp2;

--
-- Name: association_images_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wgn_tmp2
--

ALTER SEQUENCE association_images_id_seq OWNED BY association_images.id;


--
-- Name: associations; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE associations (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    description text NOT NULL,
    latitude numeric(20,18) NOT NULL,
    longitude numeric(21,18) NOT NULL,
    address character varying(255),
    input_map_data text NOT NULL,
    phone_1 character varying(20) NOT NULL,
    phone_2 character varying(20),
    website character varying(70),
    email character varying(70) NOT NULL,
    is_published integer NOT NULL,
    updated_at timestamp(0) without time zone DEFAULT ('now'::text)::timestamp(0) with time zone NOT NULL,
    created_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE associations OWNER TO wgn_tmp2;

--
-- Name: associations_id_seq; Type: SEQUENCE; Schema: public; Owner: wgn_tmp2
--

CREATE SEQUENCE associations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE associations_id_seq OWNER TO wgn_tmp2;

--
-- Name: associations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wgn_tmp2
--

ALTER SEQUENCE associations_id_seq OWNED BY associations.id;


--
-- Name: categories; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE categories (
    id integer NOT NULL,
    parent_id integer,
    "order" integer DEFAULT 1 NOT NULL,
    name character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE categories OWNER TO wgn_tmp2;

--
-- Name: categories_id_seq; Type: SEQUENCE; Schema: public; Owner: wgn_tmp2
--

CREATE SEQUENCE categories_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE categories_id_seq OWNER TO wgn_tmp2;

--
-- Name: categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wgn_tmp2
--

ALTER SEQUENCE categories_id_seq OWNED BY categories.id;


--
-- Name: comments; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE comments (
    id integer NOT NULL,
    parent_id text,
    initiative_id integer NOT NULL,
    user_id integer NOT NULL,
    user_fullname character varying(100) NOT NULL,
    body text NOT NULL,
    updated_at timestamp(0) without time zone DEFAULT ('now'::text)::timestamp(0) with time zone NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE comments OWNER TO wgn_tmp2;

--
-- Name: comments_id_seq; Type: SEQUENCE; Schema: public; Owner: wgn_tmp2
--

CREATE SEQUENCE comments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE comments_id_seq OWNER TO wgn_tmp2;

--
-- Name: comments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wgn_tmp2
--

ALTER SEQUENCE comments_id_seq OWNED BY comments.id;


--
-- Name: data_rows; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE data_rows (
    id integer NOT NULL,
    data_type_id integer NOT NULL,
    field character varying(255) NOT NULL,
    type character varying(255) NOT NULL,
    display_name character varying(255) NOT NULL,
    required boolean DEFAULT false NOT NULL,
    browse boolean DEFAULT true NOT NULL,
    read boolean DEFAULT true NOT NULL,
    edit boolean DEFAULT true NOT NULL,
    add boolean DEFAULT true NOT NULL,
    delete boolean DEFAULT true NOT NULL,
    details text,
    "order" integer DEFAULT 1 NOT NULL
);


ALTER TABLE data_rows OWNER TO wgn_tmp2;

--
-- Name: data_rows_id_seq; Type: SEQUENCE; Schema: public; Owner: wgn_tmp2
--

CREATE SEQUENCE data_rows_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE data_rows_id_seq OWNER TO wgn_tmp2;

--
-- Name: data_rows_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wgn_tmp2
--

ALTER SEQUENCE data_rows_id_seq OWNED BY data_rows.id;


--
-- Name: data_types; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE data_types (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    display_name_singular character varying(255) NOT NULL,
    display_name_plural character varying(255) NOT NULL,
    icon character varying(255),
    model_name character varying(255),
    description character varying(255),
    generate_permissions boolean DEFAULT false NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    server_side smallint DEFAULT '0'::smallint NOT NULL,
    controller character varying(255),
    policy_name character varying(255)
);


ALTER TABLE data_types OWNER TO wgn_tmp2;

--
-- Name: data_types_id_seq; Type: SEQUENCE; Schema: public; Owner: wgn_tmp2
--

CREATE SEQUENCE data_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE data_types_id_seq OWNER TO wgn_tmp2;

--
-- Name: data_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wgn_tmp2
--

ALTER SEQUENCE data_types_id_seq OWNED BY data_types.id;


--
-- Name: initiative_images; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE initiative_images (
    id integer NOT NULL,
    initiative_id integer NOT NULL,
    name character varying(255) NOT NULL,
    url character varying(255) NOT NULL,
    size character varying(255) NOT NULL,
    updated_at timestamp(0) without time zone DEFAULT ('now'::text)::timestamp(0) with time zone NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE initiative_images OWNER TO wgn_tmp2;

--
-- Name: initiative_images_id_seq; Type: SEQUENCE; Schema: public; Owner: wgn_tmp2
--

CREATE SEQUENCE initiative_images_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE initiative_images_id_seq OWNER TO wgn_tmp2;

--
-- Name: initiative_images_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wgn_tmp2
--

ALTER SEQUENCE initiative_images_id_seq OWNED BY initiative_images.id;


--
-- Name: initiative_type_translations; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE initiative_type_translations (
    id integer NOT NULL,
    initiative_type_id integer NOT NULL,
    name character varying(255) NOT NULL,
    locale character varying(10) NOT NULL,
    updated_at timestamp(0) without time zone DEFAULT ('now'::text)::timestamp(0) with time zone NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE initiative_type_translations OWNER TO wgn_tmp2;

--
-- Name: initiative_type_translations_id_seq; Type: SEQUENCE; Schema: public; Owner: wgn_tmp2
--

CREATE SEQUENCE initiative_type_translations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE initiative_type_translations_id_seq OWNER TO wgn_tmp2;

--
-- Name: initiative_type_translations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wgn_tmp2
--

ALTER SEQUENCE initiative_type_translations_id_seq OWNED BY initiative_type_translations.id;


--
-- Name: initiative_types; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE initiative_types (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    updated_at timestamp(0) without time zone DEFAULT ('now'::text)::timestamp(0) with time zone NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE initiative_types OWNER TO wgn_tmp2;

--
-- Name: initiative_types_id_seq; Type: SEQUENCE; Schema: public; Owner: wgn_tmp2
--

CREATE SEQUENCE initiative_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE initiative_types_id_seq OWNER TO wgn_tmp2;

--
-- Name: initiative_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wgn_tmp2
--

ALTER SEQUENCE initiative_types_id_seq OWNED BY initiative_types.id;


--
-- Name: initiatives; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE initiatives (
    id integer NOT NULL,
    initiative_type_id integer NOT NULL,
    user_id integer NOT NULL,
    title character varying(255) NOT NULL,
    description text NOT NULL,
    latitude numeric(20,18) NOT NULL,
    longitude numeric(21,18) NOT NULL,
    address character varying(255),
    input_map_data text NOT NULL,
    start_date timestamp(0) without time zone NOT NULL,
    end_date timestamp(0) without time zone NOT NULL,
    is_published integer NOT NULL,
    updated_at timestamp(0) without time zone DEFAULT ('now'::text)::timestamp(0) with time zone NOT NULL,
    created_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE initiatives OWNER TO wgn_tmp2;

--
-- Name: initiatives_id_seq; Type: SEQUENCE; Schema: public; Owner: wgn_tmp2
--

CREATE SEQUENCE initiatives_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE initiatives_id_seq OWNER TO wgn_tmp2;

--
-- Name: initiatives_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wgn_tmp2
--

ALTER SEQUENCE initiatives_id_seq OWNED BY initiatives.id;


--
-- Name: menu_items; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE menu_items (
    id integer NOT NULL,
    menu_id integer,
    title character varying(255) NOT NULL,
    url character varying(255) NOT NULL,
    target character varying(255) DEFAULT '_self'::character varying NOT NULL,
    icon_class character varying(255),
    color character varying(255),
    parent_id integer,
    "order" integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    route character varying(255),
    parameters text
);


ALTER TABLE menu_items OWNER TO wgn_tmp2;

--
-- Name: menu_items_id_seq; Type: SEQUENCE; Schema: public; Owner: wgn_tmp2
--

CREATE SEQUENCE menu_items_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE menu_items_id_seq OWNER TO wgn_tmp2;

--
-- Name: menu_items_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wgn_tmp2
--

ALTER SEQUENCE menu_items_id_seq OWNED BY menu_items.id;


--
-- Name: menus; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE menus (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE menus OWNER TO wgn_tmp2;

--
-- Name: menus_id_seq; Type: SEQUENCE; Schema: public; Owner: wgn_tmp2
--

CREATE SEQUENCE menus_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE menus_id_seq OWNER TO wgn_tmp2;

--
-- Name: menus_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wgn_tmp2
--

ALTER SEQUENCE menus_id_seq OWNED BY menus.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE migrations OWNER TO wgn_tmp2;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: wgn_tmp2
--

CREATE SEQUENCE migrations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE migrations_id_seq OWNER TO wgn_tmp2;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wgn_tmp2
--

ALTER SEQUENCE migrations_id_seq OWNED BY migrations.id;


--
-- Name: pages; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE pages (
    id integer NOT NULL,
    author_id integer NOT NULL,
    title character varying(255) NOT NULL,
    excerpt text,
    body text,
    image character varying(255),
    slug character varying(255) NOT NULL,
    meta_description text,
    meta_keywords text,
    status character varying(255) DEFAULT 'INACTIVE'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT pages_status_check CHECK (((status)::text = ANY ((ARRAY['ACTIVE'::character varying, 'INACTIVE'::character varying])::text[])))
);


ALTER TABLE pages OWNER TO wgn_tmp2;

--
-- Name: pages_id_seq; Type: SEQUENCE; Schema: public; Owner: wgn_tmp2
--

CREATE SEQUENCE pages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE pages_id_seq OWNER TO wgn_tmp2;

--
-- Name: pages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wgn_tmp2
--

ALTER SEQUENCE pages_id_seq OWNED BY pages.id;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE password_resets (
    email character varying(70) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone DEFAULT ('now'::text)::timestamp(0) with time zone NOT NULL
);


ALTER TABLE password_resets OWNER TO wgn_tmp2;

--
-- Name: permission_groups; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE permission_groups (
    id integer NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE permission_groups OWNER TO wgn_tmp2;

--
-- Name: permission_groups_id_seq; Type: SEQUENCE; Schema: public; Owner: wgn_tmp2
--

CREATE SEQUENCE permission_groups_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE permission_groups_id_seq OWNER TO wgn_tmp2;

--
-- Name: permission_groups_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wgn_tmp2
--

ALTER SEQUENCE permission_groups_id_seq OWNED BY permission_groups.id;


--
-- Name: permission_role; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE permission_role (
    permission_id integer NOT NULL,
    role_id integer NOT NULL
);


ALTER TABLE permission_role OWNER TO wgn_tmp2;

--
-- Name: permissions; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE permissions (
    id integer NOT NULL,
    key character varying(255) NOT NULL,
    table_name character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    permission_group_id integer
);


ALTER TABLE permissions OWNER TO wgn_tmp2;

--
-- Name: permissions_id_seq; Type: SEQUENCE; Schema: public; Owner: wgn_tmp2
--

CREATE SEQUENCE permissions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE permissions_id_seq OWNER TO wgn_tmp2;

--
-- Name: permissions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wgn_tmp2
--

ALTER SEQUENCE permissions_id_seq OWNED BY permissions.id;


--
-- Name: posts; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE posts (
    id integer NOT NULL,
    author_id integer NOT NULL,
    category_id integer,
    title character varying(255) NOT NULL,
    seo_title character varying(255),
    excerpt text,
    body text NOT NULL,
    image character varying(255),
    slug character varying(255) NOT NULL,
    meta_description text,
    meta_keywords text,
    status character varying(255) DEFAULT 'DRAFT'::character varying NOT NULL,
    featured boolean DEFAULT false NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT posts_status_check CHECK (((status)::text = ANY ((ARRAY['PUBLISHED'::character varying, 'DRAFT'::character varying, 'PENDING'::character varying])::text[])))
);


ALTER TABLE posts OWNER TO wgn_tmp2;

--
-- Name: posts_id_seq; Type: SEQUENCE; Schema: public; Owner: wgn_tmp2
--

CREATE SEQUENCE posts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE posts_id_seq OWNER TO wgn_tmp2;

--
-- Name: posts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wgn_tmp2
--

ALTER SEQUENCE posts_id_seq OWNED BY posts.id;


--
-- Name: roles; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE roles (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    display_name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE roles OWNER TO wgn_tmp2;

--
-- Name: roles_id_seq; Type: SEQUENCE; Schema: public; Owner: wgn_tmp2
--

CREATE SEQUENCE roles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE roles_id_seq OWNER TO wgn_tmp2;

--
-- Name: roles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wgn_tmp2
--

ALTER SEQUENCE roles_id_seq OWNED BY roles.id;


--
-- Name: settings; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE settings (
    id integer NOT NULL,
    key character varying(255) NOT NULL,
    display_name character varying(255) NOT NULL,
    value text NOT NULL,
    details text,
    type character varying(255) NOT NULL,
    "order" integer DEFAULT 1 NOT NULL,
    "group" character varying(255)
);


ALTER TABLE settings OWNER TO wgn_tmp2;

--
-- Name: settings_id_seq; Type: SEQUENCE; Schema: public; Owner: wgn_tmp2
--

CREATE SEQUENCE settings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE settings_id_seq OWNER TO wgn_tmp2;

--
-- Name: settings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wgn_tmp2
--

ALTER SEQUENCE settings_id_seq OWNED BY settings.id;


--
-- Name: translations; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE translations (
    id integer NOT NULL,
    table_name character varying(255) NOT NULL,
    column_name character varying(255) NOT NULL,
    foreign_key integer NOT NULL,
    locale character varying(255) NOT NULL,
    value text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE translations OWNER TO wgn_tmp2;

--
-- Name: translations_id_seq; Type: SEQUENCE; Schema: public; Owner: wgn_tmp2
--

CREATE SEQUENCE translations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE translations_id_seq OWNER TO wgn_tmp2;

--
-- Name: translations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wgn_tmp2
--

ALTER SEQUENCE translations_id_seq OWNED BY translations.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: wgn_tmp2
--

CREATE TABLE users (
    id integer NOT NULL,
    name character varying(100) NOT NULL,
    email character varying(70),
    password character varying(255),
    remember_token character varying(100),
    updated_at timestamp(0) without time zone DEFAULT ('now'::text)::timestamp(0) with time zone NOT NULL,
    created_at timestamp(0) without time zone,
    avatar character varying(255) DEFAULT 'users/default.png'::character varying,
    role_id integer
);


ALTER TABLE users OWNER TO wgn_tmp2;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: wgn_tmp2
--

CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE users_id_seq OWNER TO wgn_tmp2;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: wgn_tmp2
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- Name: association_images id; Type: DEFAULT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY association_images ALTER COLUMN id SET DEFAULT nextval('association_images_id_seq'::regclass);


--
-- Name: associations id; Type: DEFAULT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY associations ALTER COLUMN id SET DEFAULT nextval('associations_id_seq'::regclass);


--
-- Name: categories id; Type: DEFAULT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY categories ALTER COLUMN id SET DEFAULT nextval('categories_id_seq'::regclass);


--
-- Name: comments id; Type: DEFAULT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY comments ALTER COLUMN id SET DEFAULT nextval('comments_id_seq'::regclass);


--
-- Name: data_rows id; Type: DEFAULT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY data_rows ALTER COLUMN id SET DEFAULT nextval('data_rows_id_seq'::regclass);


--
-- Name: data_types id; Type: DEFAULT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY data_types ALTER COLUMN id SET DEFAULT nextval('data_types_id_seq'::regclass);


--
-- Name: initiative_images id; Type: DEFAULT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY initiative_images ALTER COLUMN id SET DEFAULT nextval('initiative_images_id_seq'::regclass);


--
-- Name: initiative_type_translations id; Type: DEFAULT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY initiative_type_translations ALTER COLUMN id SET DEFAULT nextval('initiative_type_translations_id_seq'::regclass);


--
-- Name: initiative_types id; Type: DEFAULT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY initiative_types ALTER COLUMN id SET DEFAULT nextval('initiative_types_id_seq'::regclass);


--
-- Name: initiatives id; Type: DEFAULT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY initiatives ALTER COLUMN id SET DEFAULT nextval('initiatives_id_seq'::regclass);


--
-- Name: menu_items id; Type: DEFAULT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY menu_items ALTER COLUMN id SET DEFAULT nextval('menu_items_id_seq'::regclass);


--
-- Name: menus id; Type: DEFAULT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY menus ALTER COLUMN id SET DEFAULT nextval('menus_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY migrations ALTER COLUMN id SET DEFAULT nextval('migrations_id_seq'::regclass);


--
-- Name: pages id; Type: DEFAULT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY pages ALTER COLUMN id SET DEFAULT nextval('pages_id_seq'::regclass);


--
-- Name: permission_groups id; Type: DEFAULT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY permission_groups ALTER COLUMN id SET DEFAULT nextval('permission_groups_id_seq'::regclass);


--
-- Name: permissions id; Type: DEFAULT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY permissions ALTER COLUMN id SET DEFAULT nextval('permissions_id_seq'::regclass);


--
-- Name: posts id; Type: DEFAULT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY posts ALTER COLUMN id SET DEFAULT nextval('posts_id_seq'::regclass);


--
-- Name: roles id; Type: DEFAULT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY roles ALTER COLUMN id SET DEFAULT nextval('roles_id_seq'::regclass);


--
-- Name: settings id; Type: DEFAULT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY settings ALTER COLUMN id SET DEFAULT nextval('settings_id_seq'::regclass);


--
-- Name: translations id; Type: DEFAULT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY translations ALTER COLUMN id SET DEFAULT nextval('translations_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- Data for Name: association_images; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY association_images (id, association_id, name, url, size, updated_at, created_at) FROM stdin;
1	4	b81f8540a56207deb676917162bcbccc2fbb5966.jpg	http://wgn.tmp.com/storage/associations/b81f8540a56207deb676917162bcbccc2fbb5966.jpg	207938	2017-11-29 13:29:06	2017-11-29 13:29:06
2	4	c10720f058da5f0e6224901f6769f5347611f50b.jpg	http://wgn.tmp.com/storage/associations/c10720f058da5f0e6224901f6769f5347611f50b.jpg	262765	2017-11-29 13:29:06	2017-11-29 13:29:06
3	7	23f4f86c570d0abd4b575f8c300333fc9109b7be.jpg	http://wgn.tmp.com/storage/associations/23f4f86c570d0abd4b575f8c300333fc9109b7be.jpg	39793	2017-11-30 14:54:06	2017-11-30 14:54:06
4	7	8b8a5181a091ec3a9d613d27293d332dbd8f87cc.jpg	http://wgn.tmp.com/storage/associations/8b8a5181a091ec3a9d613d27293d332dbd8f87cc.jpg	794903	2017-11-30 14:54:06	2017-11-30 14:54:06
5	7	d748e7ce3c123b6208e430d7cbd0000d4a688d80.jpg	http://wgn.tmp.com/storage/associations/d748e7ce3c123b6208e430d7cbd0000d4a688d80.jpg	140865	2017-11-30 14:54:06	2017-11-30 14:54:06
6	7	62a6d092bb79e6a773814a44bf01e92eb8f1b231.jpg	http://wgn.tmp.com/storage/associations/62a6d092bb79e6a773814a44bf01e92eb8f1b231.jpg	68254	2017-11-30 14:54:06	2017-11-30 14:54:06
\.


--
-- Name: association_images_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wgn_tmp2
--

SELECT pg_catalog.setval('association_images_id_seq', 6, true);


--
-- Data for Name: associations; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY associations (id, title, description, latitude, longitude, address, input_map_data, phone_1, phone_2, website, email, is_published, updated_at, created_at, deleted_at) FROM stdin;
4	Test title	When children decide on their own to contribute 'wholeheartedly' for the other kids, our society as a whole is affected positively and progresses as a moral, cultural and most importantly - humane society.\r\nAs part of the 'Good Deeds Month' held at the 'Hadar Mall' in Jerusalem, the 'Mikol Halev' booths at the mall collected thousands of games, clothing and footwear for the needy.	45.069035029169350000	7.674121856689454000	Quadrilatero Romano, Circoscrizione 1, Turin, TO, Piemont, 10144, Italy	{'areaId':'9f40b2b7-c473-11e7-978b-0bb1bf03d712','areaName':'Centro','osmId':'1','type':'quartieri','zoom':'13','src':'InputMap','tileId':'4270:2944:13','tile':'[4270,2944,13]','address':'{"neighbourhood":"Quadrilatero Romano","suburb":"Circoscrizione 1","city":"Turin","county":"TO","state":"Piemont","postcode":"10144","country":"Italy","country_code":"it"}'}	+74 789 789 7896	+74 789 789 7895	www.example.com	admin@example.com	1	2017-11-29 13:29:04	2017-11-29 13:29:04	\N
7	Carers Network	Hosted by the Westminster Carers Service\r\n\r\nWestminster Carers Time Bank is specifically designed to give Carers the chance to share skills, knowledge and experience, make friends and build communities within the bourough of Westminster.\r\n\r\nWestminster Carers Service is a local charity providing home based respite breaks and support for carers of people resident in the City of Westminster since 1988.\r\n\r\nFrom 1st April 2014 Westminster Carers Service will have two staff, each working 20 hours per week, and they are:-\r\n\r\nViola Etienne Timebank Project Co-ordinator\r\n\r\nPhilippa Lalor Time Broker\r\n\r\nWestminster Carers Service runs the Carers Timebank which is funded by the Big Lottery for five years. Please contact Viola or Philippa if you would like to know more about the Timebank.	45.072672010932840000	7.671718597412110000	Quadrilatero Romano, Circoscrizione 1, Turin, TO, Piemont, 10144, Italy	{'areaId':'9f40b2b7-c473-11e7-978b-0bb1bf03d712','areaName':'Centro','osmId':'1','type':'quartieri','zoom':'13','src':'InputMap','tileId':'4270:2944:13','tile':'[4270,2944,13]','address':'{"neighbourhood":"Quadrilatero Romano","suburb":"Circoscrizione 1","city":"Turin","county":"TO","state":"Piemont","postcode":"10144","country":"Italy","country_code":"it"}'}	0208 9603033	\N	http://carers-network.org.uk/	viola.etienne@carers-network.co.uk	1	2017-12-01 15:27:45	2017-11-30 14:54:03	\N
\.


--
-- Name: associations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wgn_tmp2
--

SELECT pg_catalog.setval('associations_id_seq', 7, true);


--
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY categories (id, parent_id, "order", name, slug, created_at, updated_at) FROM stdin;
\.


--
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wgn_tmp2
--

SELECT pg_catalog.setval('categories_id_seq', 1, false);


--
-- Data for Name: comments; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY comments (id, parent_id, initiative_id, user_id, user_fullname, body, updated_at, created_at) FROM stdin;
1	\N	1	1	Alex Mokkas	Ok. Let's do it!	2017-12-01 12:54:20	2017-12-01 12:54:20
\.


--
-- Name: comments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wgn_tmp2
--

SELECT pg_catalog.setval('comments_id_seq', 1, true);


--
-- Data for Name: data_rows; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY data_rows (id, data_type_id, field, type, display_name, required, browse, read, edit, add, delete, details, "order") FROM stdin;
1	1	id	number	ID	t	f	f	f	f	f		1
2	1	author_id	text	Author	t	f	t	t	f	t		2
3	1	category_id	text	Category	t	f	t	t	t	f		3
4	1	title	text	Title	t	t	t	t	t	t		4
5	1	excerpt	text_area	excerpt	t	f	t	t	t	t		5
6	1	body	rich_text_box	Body	t	f	t	t	t	t		6
7	1	image	image	Post Image	f	t	t	t	t	t	{"resize":{"width":"1000","height":"null"},"quality":"70%","upsize":true,"thumbnails":[{"name":"medium","scale":"50%"},{"name":"small","scale":"25%"},{"name":"cropped","crop":{"width":"300","height":"250"}}]}	7
8	1	slug	text	slug	t	f	t	t	t	t	{"slugify":{"origin":"title","forceUpdate":true}}	8
9	1	meta_description	text_area	meta_description	t	f	t	t	t	t		9
10	1	meta_keywords	text_area	meta_keywords	t	f	t	t	t	t		10
11	1	status	select_dropdown	status	t	t	t	t	t	t	{"default":"DRAFT","options":{"PUBLISHED":"published","DRAFT":"draft","PENDING":"pending"}}	11
12	1	created_at	timestamp	created_at	f	t	t	f	f	f		12
13	1	updated_at	timestamp	updated_at	f	f	f	f	f	f		13
14	2	id	number	id	t	f	f	f	f	f		1
15	2	author_id	text	author_id	t	f	f	f	f	f		2
16	2	title	text	title	t	t	t	t	t	t		3
17	2	excerpt	text_area	excerpt	t	f	t	t	t	t		4
18	2	body	rich_text_box	body	t	f	t	t	t	t		5
19	2	slug	text	slug	t	f	t	t	t	t	{"slugify":{"origin":"title"}}	6
20	2	meta_description	text	meta_description	t	f	t	t	t	t		7
21	2	meta_keywords	text	meta_keywords	t	f	t	t	t	t		8
22	2	status	select_dropdown	status	t	t	t	t	t	t	{"default":"INACTIVE","options":{"INACTIVE":"INACTIVE","ACTIVE":"ACTIVE"}}	9
23	2	created_at	timestamp	created_at	t	t	t	f	f	f		10
24	2	updated_at	timestamp	updated_at	t	f	f	f	f	f		11
25	2	image	image	image	f	t	t	t	t	t		12
26	3	id	number	id	t	f	f	f	f	f		1
27	3	name	text	name	t	t	t	t	t	t		2
28	3	email	text	email	t	t	t	t	t	t		3
29	3	password	password	password	f	f	f	t	t	f		4
30	3	user_belongsto_role_relationship	relationship	Role	f	t	t	t	t	f	{"model":"TCG\\\\Voyager\\\\Models\\\\Role","table":"roles","type":"belongsTo","column":"role_id","key":"id","label":"name","pivot_table":"roles","pivot":"0"}	10
31	3	remember_token	text	remember_token	f	f	f	f	f	f		5
32	3	created_at	timestamp	created_at	f	t	t	f	f	f		6
33	3	updated_at	timestamp	updated_at	f	f	f	f	f	f		7
34	3	avatar	image	avatar	f	t	t	t	t	t		8
35	5	id	number	id	t	f	f	f	f	f		1
36	5	name	text	name	t	t	t	t	t	t		2
37	5	created_at	timestamp	created_at	f	f	f	f	f	f		3
38	5	updated_at	timestamp	updated_at	f	f	f	f	f	f		4
39	4	id	number	id	t	f	f	f	f	f		1
40	4	parent_id	select_dropdown	parent_id	f	f	t	t	t	t	{"default":"","null":"","options":{"":"-- None --"},"relationship":{"key":"id","label":"name"}}	2
41	4	order	text	order	t	t	t	t	t	t	{"default":1}	3
42	4	name	text	name	t	t	t	t	t	t		4
43	4	slug	text	slug	t	t	t	t	t	t	{"slugify":{"origin":"name"}}	5
44	4	created_at	timestamp	created_at	f	f	t	f	f	f		6
45	4	updated_at	timestamp	updated_at	f	f	f	f	f	f		7
46	6	id	number	id	t	f	f	f	f	f		1
47	6	name	text	Name	t	t	t	t	t	t		2
48	6	created_at	timestamp	created_at	f	f	f	f	f	f		3
49	6	updated_at	timestamp	updated_at	f	f	f	f	f	f		4
50	6	display_name	text	Display Name	t	t	t	t	t	t		5
51	1	seo_title	text	seo_title	f	t	t	t	t	t		14
52	1	featured	checkbox	featured	t	t	t	t	t	t		15
53	3	role_id	text	role_id	t	t	t	t	t	t		9
54	7	id	number	Id	t	f	f	f	f	f	\N	1
55	7	initiative_type_id	select_dropdown	Initiative Type Id	t	f	f	f	f	f	\N	2
56	7	user_id	number	User Id	t	f	t	f	f	f	\N	4
57	7	title	text	Title	t	t	t	f	f	f	\N	5
58	7	description	text	Description	t	f	t	f	f	f	\N	6
59	7	latitude	text	Latitude	t	f	t	f	f	f	\N	7
60	7	longitude	text	Longitude	t	f	t	f	f	f	\N	8
61	7	address	text	Address	f	t	t	f	f	f	\N	9
62	7	input_map_data	text	Input Map Data	t	f	f	f	f	f	\N	10
63	7	start_date	timestamp	Start Date	t	f	t	f	f	f	\N	11
64	7	end_date	timestamp	End Date	t	f	t	f	f	f	\N	12
65	7	is_published	checkbox	Is Published	t	t	t	t	f	f	\N	13
66	7	updated_at	timestamp	Updated At	t	f	t	f	f	f	\N	14
67	7	created_at	timestamp	Created At	f	t	t	f	f	f	\N	15
68	7	deleted_at	timestamp	Deleted At	f	f	t	f	f	f	\N	16
69	8	id	number	Id	t	f	f	f	f	f	\N	1
70	8	name	checkbox	Name	t	t	t	f	f	f	\N	2
71	8	updated_at	timestamp	Updated At	t	f	f	f	f	f	\N	3
72	8	created_at	timestamp	Created At	f	f	f	f	f	f	\N	4
85	10	latitude	text	Latitude	t	f	t	t	t	t	\N	4
86	10	longitude	text	Longitude	t	f	t	t	t	t	\N	5
74	9	id	checkbox	Id	t	f	f	f	f	f	\N	1
75	9	initiative_id	checkbox	Initiative Id	t	t	t	f	f	f	\N	2
76	9	name	checkbox	Name	t	t	t	f	f	f	\N	3
77	9	url	checkbox	Url	t	t	t	f	f	f	\N	4
78	9	size	checkbox	Size	t	f	f	f	f	f	\N	5
79	9	updated_at	timestamp	Updated At	t	f	f	f	f	f	\N	6
80	9	created_at	timestamp	Created At	f	f	f	f	f	f	\N	7
87	10	address	text	Address	f	t	t	t	t	t	\N	6
88	10	input_map_data	checkbox	Input Map Data	t	f	f	f	f	f	\N	7
89	10	phone_1	text	Phone 1	t	f	t	t	t	t	\N	8
90	10	phone_2	text	Phone 2	f	f	t	t	t	t	\N	9
91	10	website	text	Website	f	f	t	t	t	t	\N	10
92	10	email	text	Email	t	f	t	t	t	t	\N	11
93	10	is_published	checkbox	Is Published	t	t	t	t	t	t	\N	12
94	10	updated_at	timestamp	Updated At	t	f	f	f	f	f	\N	13
95	10	created_at	timestamp	Created At	f	f	f	f	f	f	\N	14
96	10	deleted_at	timestamp	Deleted At	f	f	f	f	f	f	\N	15
97	10	association_hasmany_association_image_relationship	relationship	Images	f	f	t	t	t	t	{"model":"App\\\\AssociationImage","table":"association_images","type":"hasMany","column":"association_id","key":"id","label":"url","pivot_table":"migrations","pivot":"0"}	16
73	7	initiative_belongsto_initiative_type_relationship	relationship	Initiative type	f	t	t	t	f	f	{"model":"App\\\\InitiativeType","table":"initiative_types","type":"belongsTo","column":"initiative_type_id","key":"id","label":"name","pivot_table":"migrations","pivot":"0"}	3
81	7	initiative_hasmany_initiative_image_relationship	relationship	Ιmages	f	f	t	f	f	t	{"model":"App\\\\InitiativeImage","table":"initiative_images","type":"hasMany","column":"initiative_id","key":"id","label":"url","pivot_table":"migrations","pivot":"0"}	17
82	10	id	checkbox	Id	t	f	f	f	f	f	\N	1
83	10	title	text	Title	t	t	t	t	t	t	\N	2
84	10	description	text_area	Description	t	f	t	t	t	t	\N	3
\.


--
-- Name: data_rows_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wgn_tmp2
--

SELECT pg_catalog.setval('data_rows_id_seq', 97, true);


--
-- Data for Name: data_types; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY data_types (id, name, slug, display_name_singular, display_name_plural, icon, model_name, description, generate_permissions, created_at, updated_at, server_side, controller, policy_name) FROM stdin;
1	posts	posts	Post	Posts	voyager-news	TCG\\Voyager\\Models\\Post		t	2017-11-27 10:03:09	2017-11-27 10:03:09	0		TCG\\Voyager\\Policies\\PostPolicy
2	pages	pages	Page	Pages	voyager-file-text	TCG\\Voyager\\Models\\Page		t	2017-11-27 10:03:09	2017-11-27 10:03:09	0		\N
3	users	users	User	Users	voyager-person	TCG\\Voyager\\Models\\User		t	2017-11-27 10:03:09	2017-11-27 10:03:09	0		TCG\\Voyager\\Policies\\UserPolicy
4	categories	categories	Category	Categories	voyager-categories	TCG\\Voyager\\Models\\Category		t	2017-11-27 10:03:09	2017-11-27 10:03:09	0		\N
5	menus	menus	Menu	Menus	voyager-list	TCG\\Voyager\\Models\\Menu		t	2017-11-27 10:03:09	2017-11-27 10:03:09	0		\N
6	roles	roles	Role	Roles	voyager-lock	TCG\\Voyager\\Models\\Role		t	2017-11-27 10:03:09	2017-11-27 10:03:09	0		\N
8	initiative_types	initiative-types	Initiative Type	Initiative Types	\N	App\\InitiativeType	\N	t	2017-11-27 10:15:48	2017-11-27 10:22:07	0	\N	\N
9	initiative_images	initiative-images	Initiative Image	Initiative Images	\N	App\\InitiativeImage	\N	t	2017-11-27 13:52:47	2017-11-28 15:09:17	0	\N	\N
7	initiatives	initiatives	Initiative	Initiatives	voyager-activity	App\\Initiative	\N	t	2017-11-27 10:14:47	2017-12-01 14:15:16	0	\N	\N
10	associations	associations	Association	Associations	voyager-group	App\\Association	\N	t	2017-11-30 15:52:50	2017-12-01 15:39:55	0	\N	\N
\.


--
-- Name: data_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wgn_tmp2
--

SELECT pg_catalog.setval('data_types_id_seq', 10, true);


--
-- Data for Name: initiative_images; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY initiative_images (id, initiative_id, name, url, size, updated_at, created_at) FROM stdin;
1	1	2FDSC_0013.jpg	http://wgn.tmp.com/storage/initiatives/2FDSC_0013.jpg	2423423	2017-11-28 17:12:38	2017-11-28 17:12:38
2	1	024-West-Norwood-Feast-GP.jpg	http://wgn.tmp.com/storage/initiatives/024-West-Norwood-Feast-GP.jpg	2423423	2017-11-28 17:14:42	2017-11-28 17:14:42
\.


--
-- Name: initiative_images_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wgn_tmp2
--

SELECT pg_catalog.setval('initiative_images_id_seq', 2, true);


--
-- Data for Name: initiative_type_translations; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY initiative_type_translations (id, initiative_type_id, name, locale, updated_at, created_at) FROM stdin;
1	1	Offers	en	2017-11-27 12:04:33	2017-11-27 10:04:33
2	2	Demands	en	2017-11-27 12:04:33	2017-11-27 10:04:33
\.


--
-- Name: initiative_type_translations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wgn_tmp2
--

SELECT pg_catalog.setval('initiative_type_translations_id_seq', 2, true);


--
-- Data for Name: initiative_types; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY initiative_types (id, name, updated_at, created_at) FROM stdin;
1	Offers	2017-11-27 12:04:33	2017-11-27 10:04:33
2	Demands	2017-11-27 12:04:33	2017-11-27 10:04:33
\.


--
-- Name: initiative_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wgn_tmp2
--

SELECT pg_catalog.setval('initiative_types_id_seq', 1, false);


--
-- Data for Name: initiatives; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY initiatives (id, initiative_type_id, user_id, title, description, latitude, longitude, address, input_map_data, start_date, end_date, is_published, updated_at, created_at, deleted_at) FROM stdin;
4	2	3	URGENT - Move some furniture so Mrs M can get home	Move some furniture so Mrs M can get home	45.069035029169350000	7.674121856689454000	kalamaria	test	2017-08-23 09:00:00	2017-08-23 14:00:00	1	2017-11-27 14:19:07	2017-11-27 14:19:07	\N
1	1	3	Run in the borough of Bromley!	Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.	45.072672010932840000	7.671718597412110000	Vasilissis Olgas 221, 54889	input data	2016-10-01 09:20:00	2016-10-31 12:00:00	1	2017-11-27 15:09:55	2017-11-27 14:50:39	\N
\.


--
-- Name: initiatives_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wgn_tmp2
--

SELECT pg_catalog.setval('initiatives_id_seq', 4, true);


--
-- Data for Name: menu_items; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY menu_items (id, menu_id, title, url, target, icon_class, color, parent_id, "order", created_at, updated_at, route, parameters) FROM stdin;
9	1	Menu Builder		_self	voyager-list	\N	8	1	2017-11-27 10:03:09	2017-11-27 12:06:45	voyager.menus.index	\N
10	1	Database		_self	voyager-data	\N	8	2	2017-11-27 10:03:10	2017-11-27 12:06:45	voyager.database.index	\N
11	1	Compass	/admin/compass	_self	voyager-compass	\N	8	3	2017-11-27 10:03:10	2017-11-27 12:06:45	\N	\N
12	1	Hooks	/admin/hooks	_self	voyager-hook	\N	8	4	2017-11-27 10:03:10	2017-11-27 12:06:45	\N	\N
17	1	Associations	/admin/associations	_self	voyager-group	#000000	\N	2	2017-11-30 15:52:50	2017-11-30 16:00:10	\N	
14	1	Offers/Demands	/admin/initiatives	_self	voyager-activity	#000000	\N	1	2017-11-27 10:14:47	2017-12-01 14:32:17	\N	
4	1	Users		_self	voyager-person	\N	\N	3	2017-11-27 10:03:09	2017-12-01 14:32:17	voyager.users.index	\N
7	1	Roles		_self	voyager-lock	\N	\N	4	2017-11-27 10:03:09	2017-12-01 14:32:17	voyager.roles.index	\N
8	1	Tools		_self	voyager-tools	\N	\N	5	2017-11-27 10:03:09	2017-12-01 14:32:17	\N	\N
13	1	Settings		_self	voyager-settings	\N	\N	6	2017-11-27 10:03:10	2017-12-01 14:32:17	voyager.settings.index	\N
\.


--
-- Name: menu_items_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wgn_tmp2
--

SELECT pg_catalog.setval('menu_items_id_seq', 17, true);


--
-- Data for Name: menus; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY menus (id, name, created_at, updated_at) FROM stdin;
1	admin	2017-11-27 10:03:09	2017-11-27 10:03:09
\.


--
-- Name: menus_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wgn_tmp2
--

SELECT pg_catalog.setval('menus_id_seq', 2, true);


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY migrations (id, migration, batch) FROM stdin;
1	2014_10_12_000000_create_users_table	1
2	2014_10_12_100000_create_password_resets_table	1
3	2016_01_01_000000_add_voyager_user_fields	1
4	2016_01_01_000000_create_data_types_table	1
5	2016_01_01_000000_create_pages_table	1
6	2016_01_01_000000_create_posts_table	1
7	2016_02_15_204651_create_categories_table	1
8	2016_05_19_173453_create_menu_table	1
9	2016_10_21_190000_create_roles_table	1
10	2016_10_21_190000_create_settings_table	1
11	2016_11_30_135954_create_permission_table	1
12	2016_11_30_141208_create_permission_role_table	1
13	2016_12_26_201236_data_types__add__server_side	1
14	2017_01_13_000000_add_route_to_menu_items_table	1
15	2017_01_14_005015_create_translations_table	1
16	2017_01_15_000000_add_permission_group_id_to_permissions_table	1
17	2017_01_15_000000_create_permission_groups_table	1
18	2017_01_15_000000_make_table_name_nullable_in_permissions_table	1
19	2017_03_06_000000_add_controller_to_data_types_table	1
20	2017_04_11_000000_alter_post_nullable_fields_table	1
21	2017_04_21_000000_add_order_to_data_rows_table	1
22	2017_05_08_081402_create_initiative_types_table	1
23	2017_05_08_081506_create_initiative_type_translations_table	1
24	2017_05_08_082356_create_initiatives_table	1
25	2017_05_15_103426_create_initiative_images_table	1
26	2017_07_05_210000_add_policyname_to_data_types_table	1
27	2017_07_19_113726_create_comments_table	1
28	2017_08_05_000000_add_group_to_settings_table	1
29	2017_11_28_142912_create_associations_table	2
30	2017_11_28_150211_create_association_images_table	3
\.


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wgn_tmp2
--

SELECT pg_catalog.setval('migrations_id_seq', 30, true);


--
-- Data for Name: pages; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY pages (id, author_id, title, excerpt, body, image, slug, meta_description, meta_keywords, status, created_at, updated_at) FROM stdin;
\.


--
-- Name: pages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wgn_tmp2
--

SELECT pg_catalog.setval('pages_id_seq', 1, false);


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: permission_groups; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY permission_groups (id, name) FROM stdin;
\.


--
-- Name: permission_groups_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wgn_tmp2
--

SELECT pg_catalog.setval('permission_groups_id_seq', 1, false);


--
-- Data for Name: permission_role; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY permission_role (permission_id, role_id) FROM stdin;
1	1
2	1
3	1
4	1
5	1
6	1
7	1
8	1
9	1
10	1
11	1
12	1
13	1
14	1
15	1
16	1
17	1
18	1
19	1
20	1
21	1
22	1
23	1
24	1
25	1
26	1
27	1
28	1
29	1
30	1
31	1
32	1
33	1
34	1
35	1
36	1
37	1
38	1
39	1
40	1
41	1
42	1
43	1
44	1
45	1
46	1
47	1
48	1
49	1
40	3
41	3
42	3
44	3
1	3
20	3
21	3
50	1
51	1
52	1
53	1
54	1
55	1
56	1
57	1
58	1
59	1
\.


--
-- Data for Name: permissions; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY permissions (id, key, table_name, created_at, updated_at, permission_group_id) FROM stdin;
1	browse_admin	\N	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
2	browse_database	\N	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
3	browse_media	\N	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
4	browse_compass	\N	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
5	browse_menus	menus	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
6	read_menus	menus	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
7	edit_menus	menus	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
8	add_menus	menus	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
9	delete_menus	menus	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
10	browse_pages	pages	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
11	read_pages	pages	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
12	edit_pages	pages	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
13	add_pages	pages	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
14	delete_pages	pages	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
15	browse_roles	roles	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
16	read_roles	roles	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
17	edit_roles	roles	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
18	add_roles	roles	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
19	delete_roles	roles	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
20	browse_users	users	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
21	read_users	users	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
22	edit_users	users	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
23	add_users	users	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
24	delete_users	users	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
25	browse_posts	posts	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
26	read_posts	posts	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
27	edit_posts	posts	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
28	add_posts	posts	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
29	delete_posts	posts	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
30	browse_categories	categories	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
31	read_categories	categories	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
32	edit_categories	categories	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
33	add_categories	categories	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
34	delete_categories	categories	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
35	browse_settings	settings	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
36	read_settings	settings	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
37	edit_settings	settings	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
38	add_settings	settings	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
39	delete_settings	settings	2017-11-27 10:03:10	2017-11-27 10:03:10	\N
40	browse_initiatives	initiatives	2017-11-27 10:14:47	2017-11-27 10:14:47	\N
41	read_initiatives	initiatives	2017-11-27 10:14:47	2017-11-27 10:14:47	\N
42	edit_initiatives	initiatives	2017-11-27 10:14:47	2017-11-27 10:14:47	\N
43	add_initiatives	initiatives	2017-11-27 10:14:47	2017-11-27 10:14:47	\N
44	delete_initiatives	initiatives	2017-11-27 10:14:47	2017-11-27 10:14:47	\N
45	browse_initiative_types	initiative_types	2017-11-27 10:15:48	2017-11-27 10:15:48	\N
46	read_initiative_types	initiative_types	2017-11-27 10:15:48	2017-11-27 10:15:48	\N
47	edit_initiative_types	initiative_types	2017-11-27 10:15:48	2017-11-27 10:15:48	\N
48	add_initiative_types	initiative_types	2017-11-27 10:15:48	2017-11-27 10:15:48	\N
49	delete_initiative_types	initiative_types	2017-11-27 10:15:48	2017-11-27 10:15:48	\N
50	browse_initiative_images	initiative_images	2017-11-27 13:52:47	2017-11-27 13:52:47	\N
51	read_initiative_images	initiative_images	2017-11-27 13:52:47	2017-11-27 13:52:47	\N
52	edit_initiative_images	initiative_images	2017-11-27 13:52:47	2017-11-27 13:52:47	\N
53	add_initiative_images	initiative_images	2017-11-27 13:52:47	2017-11-27 13:52:47	\N
54	delete_initiative_images	initiative_images	2017-11-27 13:52:47	2017-11-27 13:52:47	\N
55	browse_associations	associations	2017-11-30 15:52:50	2017-11-30 15:52:50	\N
56	read_associations	associations	2017-11-30 15:52:50	2017-11-30 15:52:50	\N
57	edit_associations	associations	2017-11-30 15:52:50	2017-11-30 15:52:50	\N
58	add_associations	associations	2017-11-30 15:52:50	2017-11-30 15:52:50	\N
59	delete_associations	associations	2017-11-30 15:52:50	2017-11-30 15:52:50	\N
\.


--
-- Name: permissions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wgn_tmp2
--

SELECT pg_catalog.setval('permissions_id_seq', 59, true);


--
-- Data for Name: posts; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY posts (id, author_id, category_id, title, seo_title, excerpt, body, image, slug, meta_description, meta_keywords, status, featured, created_at, updated_at) FROM stdin;
\.


--
-- Name: posts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wgn_tmp2
--

SELECT pg_catalog.setval('posts_id_seq', 1, false);


--
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY roles (id, name, display_name, created_at, updated_at) FROM stdin;
1	admin	Administrator	2017-11-27 10:03:10	2017-11-27 10:03:10
2	user	Normal User	2017-11-27 10:03:10	2017-11-27 10:03:10
3	moderator	Moderator	2017-11-27 12:09:43	2017-11-27 12:09:54
\.


--
-- Name: roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wgn_tmp2
--

SELECT pg_catalog.setval('roles_id_seq', 3, true);


--
-- Data for Name: settings; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY settings (id, key, display_name, value, details, type, "order", "group") FROM stdin;
\.


--
-- Name: settings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wgn_tmp2
--

SELECT pg_catalog.setval('settings_id_seq', 1, false);


--
-- Data for Name: translations; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY translations (id, table_name, column_name, foreign_key, locale, value, created_at, updated_at) FROM stdin;
\.


--
-- Name: translations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wgn_tmp2
--

SELECT pg_catalog.setval('translations_id_seq', 1, false);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: wgn_tmp2
--

COPY users (id, name, email, password, remember_token, updated_at, created_at, avatar, role_id) FROM stdin;
2	Alex Moderator	alex@infalia.com	$2y$10$troiYAlm/0JJmJ2Yw3Qz3uz/3BA8DRm4oz0hyUWPvc8u3qv5keAEK	\N	2017-11-27 12:10:41	2017-11-27 12:10:41	users/default.png	3
3	Alex Normal	alexis@infalia.com	$2y$10$fs3AopMfD1oN9qyyrU54LOPPhOhvoS4JWjsDAKg6IuBNyWkevegfO	\N	2017-11-27 12:47:28	2017-11-27 12:47:28	users/default.png	2
1	Alex Mokkas	mokkas@infalia.com	$2y$10$QFKJT2bPIKuFHSvBdkr1eOFGIZeMbROYq1LKCXJBhH6CTCWv3.qGy	9NJyk9ZQfK8LznbCohy0iBIRaHG0JaMfHqTbKBtRjuqqYILsI1iVOHV5uTm3	2017-11-27 10:05:29	2017-11-27 10:05:29	users/default.png	1
\.


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wgn_tmp2
--

SELECT pg_catalog.setval('users_id_seq', 3, true);


--
-- Name: association_images association_images_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY association_images
    ADD CONSTRAINT association_images_pkey PRIMARY KEY (id);


--
-- Name: associations associations_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY associations
    ADD CONSTRAINT associations_pkey PRIMARY KEY (id);


--
-- Name: categories categories_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);


--
-- Name: categories categories_slug_unique; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY categories
    ADD CONSTRAINT categories_slug_unique UNIQUE (slug);


--
-- Name: comments comments_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY comments
    ADD CONSTRAINT comments_pkey PRIMARY KEY (id);


--
-- Name: data_rows data_rows_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY data_rows
    ADD CONSTRAINT data_rows_pkey PRIMARY KEY (id);


--
-- Name: data_types data_types_name_unique; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY data_types
    ADD CONSTRAINT data_types_name_unique UNIQUE (name);


--
-- Name: data_types data_types_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY data_types
    ADD CONSTRAINT data_types_pkey PRIMARY KEY (id);


--
-- Name: data_types data_types_slug_unique; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY data_types
    ADD CONSTRAINT data_types_slug_unique UNIQUE (slug);


--
-- Name: initiative_images initiative_images_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY initiative_images
    ADD CONSTRAINT initiative_images_pkey PRIMARY KEY (id);


--
-- Name: initiative_type_translations initiative_type_translations_initiative_type_id_locale_unique; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY initiative_type_translations
    ADD CONSTRAINT initiative_type_translations_initiative_type_id_locale_unique UNIQUE (initiative_type_id, locale);


--
-- Name: initiative_type_translations initiative_type_translations_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY initiative_type_translations
    ADD CONSTRAINT initiative_type_translations_pkey PRIMARY KEY (id);


--
-- Name: initiative_types initiative_types_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY initiative_types
    ADD CONSTRAINT initiative_types_pkey PRIMARY KEY (id);


--
-- Name: initiatives initiatives_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY initiatives
    ADD CONSTRAINT initiatives_pkey PRIMARY KEY (id);


--
-- Name: menu_items menu_items_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY menu_items
    ADD CONSTRAINT menu_items_pkey PRIMARY KEY (id);


--
-- Name: menus menus_name_unique; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY menus
    ADD CONSTRAINT menus_name_unique UNIQUE (name);


--
-- Name: menus menus_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY menus
    ADD CONSTRAINT menus_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: pages pages_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY pages
    ADD CONSTRAINT pages_pkey PRIMARY KEY (id);


--
-- Name: pages pages_slug_unique; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY pages
    ADD CONSTRAINT pages_slug_unique UNIQUE (slug);


--
-- Name: permission_groups permission_groups_name_unique; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY permission_groups
    ADD CONSTRAINT permission_groups_name_unique UNIQUE (name);


--
-- Name: permission_groups permission_groups_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY permission_groups
    ADD CONSTRAINT permission_groups_pkey PRIMARY KEY (id);


--
-- Name: permission_role permission_role_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY permission_role
    ADD CONSTRAINT permission_role_pkey PRIMARY KEY (permission_id, role_id);


--
-- Name: permissions permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY permissions
    ADD CONSTRAINT permissions_pkey PRIMARY KEY (id);


--
-- Name: posts posts_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY posts
    ADD CONSTRAINT posts_pkey PRIMARY KEY (id);


--
-- Name: posts posts_slug_unique; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY posts
    ADD CONSTRAINT posts_slug_unique UNIQUE (slug);


--
-- Name: roles roles_name_unique; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY roles
    ADD CONSTRAINT roles_name_unique UNIQUE (name);


--
-- Name: roles roles_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);


--
-- Name: settings settings_key_unique; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY settings
    ADD CONSTRAINT settings_key_unique UNIQUE (key);


--
-- Name: settings settings_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY settings
    ADD CONSTRAINT settings_pkey PRIMARY KEY (id);


--
-- Name: translations translations_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY translations
    ADD CONSTRAINT translations_pkey PRIMARY KEY (id);


--
-- Name: translations translations_table_name_column_name_foreign_key_locale_unique; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY translations
    ADD CONSTRAINT translations_table_name_column_name_foreign_key_locale_unique UNIQUE (table_name, column_name, foreign_key, locale);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: initiative_type_translations_locale_index; Type: INDEX; Schema: public; Owner: wgn_tmp2
--

CREATE INDEX initiative_type_translations_locale_index ON initiative_type_translations USING btree (locale);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: wgn_tmp2
--

CREATE INDEX password_resets_email_index ON password_resets USING btree (email);


--
-- Name: permission_role_permission_id_index; Type: INDEX; Schema: public; Owner: wgn_tmp2
--

CREATE INDEX permission_role_permission_id_index ON permission_role USING btree (permission_id);


--
-- Name: permission_role_role_id_index; Type: INDEX; Schema: public; Owner: wgn_tmp2
--

CREATE INDEX permission_role_role_id_index ON permission_role USING btree (role_id);


--
-- Name: permissions_key_index; Type: INDEX; Schema: public; Owner: wgn_tmp2
--

CREATE INDEX permissions_key_index ON permissions USING btree (key);


--
-- Name: association_images association_images_association_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY association_images
    ADD CONSTRAINT association_images_association_id_foreign FOREIGN KEY (association_id) REFERENCES associations(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: categories categories_parent_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY categories
    ADD CONSTRAINT categories_parent_id_foreign FOREIGN KEY (parent_id) REFERENCES categories(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: comments comments_initiative_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY comments
    ADD CONSTRAINT comments_initiative_id_foreign FOREIGN KEY (initiative_id) REFERENCES initiatives(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: comments comments_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY comments
    ADD CONSTRAINT comments_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id);


--
-- Name: data_rows data_rows_data_type_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY data_rows
    ADD CONSTRAINT data_rows_data_type_id_foreign FOREIGN KEY (data_type_id) REFERENCES data_types(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: initiative_images initiative_images_initiative_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY initiative_images
    ADD CONSTRAINT initiative_images_initiative_id_foreign FOREIGN KEY (initiative_id) REFERENCES initiatives(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: initiative_type_translations initiative_type_translations_initiative_type_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY initiative_type_translations
    ADD CONSTRAINT initiative_type_translations_initiative_type_id_foreign FOREIGN KEY (initiative_type_id) REFERENCES initiative_types(id) ON DELETE CASCADE;


--
-- Name: initiatives initiatives_initiative_type_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY initiatives
    ADD CONSTRAINT initiatives_initiative_type_id_foreign FOREIGN KEY (initiative_type_id) REFERENCES initiative_types(id);


--
-- Name: initiatives initiatives_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY initiatives
    ADD CONSTRAINT initiatives_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id);


--
-- Name: menu_items menu_items_menu_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY menu_items
    ADD CONSTRAINT menu_items_menu_id_foreign FOREIGN KEY (menu_id) REFERENCES menus(id) ON DELETE CASCADE;


--
-- Name: permission_role permission_role_permission_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY permission_role
    ADD CONSTRAINT permission_role_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE;


--
-- Name: permission_role permission_role_role_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: wgn_tmp2
--

ALTER TABLE ONLY permission_role
    ADD CONSTRAINT permission_role_role_id_foreign FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

