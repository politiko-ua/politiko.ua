--
-- PostgreSQL database dump
--

SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: blogs_comments; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE blogs_comments (
    id integer NOT NULL,
    post_id integer,
    user_id integer,
    text text,
    created_ts integer,
    parent_id integer DEFAULT 0 NOT NULL,
    childs text DEFAULT ''::text NOT NULL,
    rate integer DEFAULT 0 NOT NULL
);


--
-- Name: blogs_comments_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE blogs_comments_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: blogs_comments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE blogs_comments_id_seq OWNED BY blogs_comments.id;


--
-- Name: blogs_posts; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE blogs_posts (
    id integer NOT NULL,
    user_id integer NOT NULL,
    title character varying(256),
    body text NOT NULL,
    created_ts integer NOT NULL,
    rate integer DEFAULT 0 NOT NULL,
    text_rendered text NOT NULL,
    preview text NOT NULL,
    tags_text character varying,
    public boolean DEFAULT false NOT NULL,
    visible boolean DEFAULT true NOT NULL,
    fti tsvector
);


--
-- Name: blogs_posts_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE blogs_posts_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: blogs_posts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE blogs_posts_id_seq OWNED BY blogs_posts.id;


--
-- Name: blogs_posts_tags; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE blogs_posts_tags (
    post_id integer NOT NULL,
    tag_id integer NOT NULL
);


--
-- Name: blogs_tags; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE blogs_tags (
    id integer NOT NULL,
    name character varying(64) NOT NULL
);


--
-- Name: blogs_tags_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE blogs_tags_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: blogs_tags_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE blogs_tags_id_seq OWNED BY blogs_tags.id;


--
-- Name: cities; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE cities (
    id integer NOT NULL,
    region_id integer NOT NULL,
    name_ru character varying NOT NULL,
    name_ua character varying NOT NULL
);


--
-- Name: cities_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE cities_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: cities_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE cities_id_seq OWNED BY cities.id;


--
-- Name: debates; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE debates (
    id integer NOT NULL,
    user_id integer NOT NULL,
    "for" integer DEFAULT 0 NOT NULL,
    against integer DEFAULT 0 NOT NULL,
    created_ts integer NOT NULL,
    text text NOT NULL,
    tags_text character varying(255),
    visible boolean DEFAULT true NOT NULL,
    fti tsvector
);


--
-- Name: debates_arguments; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE debates_arguments (
    id integer NOT NULL,
    debate_id integer NOT NULL,
    user_id integer NOT NULL,
    created_ts integer NOT NULL,
    agree boolean DEFAULT true NOT NULL,
    text text NOT NULL,
    childs text DEFAULT ''::text NOT NULL,
    parent_id integer DEFAULT 0 NOT NULL,
    rate integer DEFAULT 0 NOT NULL,
    total integer DEFAULT 0 NOT NULL
);


--
-- Name: debates_arguments_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE debates_arguments_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: debates_arguments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE debates_arguments_id_seq OWNED BY debates_arguments.id;


--
-- Name: debates_debates_tags; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE debates_debates_tags (
    debate_id integer NOT NULL,
    tag_id integer NOT NULL
);


--
-- Name: debates_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE debates_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: debates_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE debates_id_seq OWNED BY debates.id;


--
-- Name: debates_tags; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE debates_tags (
    id integer NOT NULL,
    name character varying(64) NOT NULL
);


--
-- Name: debates_tags_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE debates_tags_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: debates_tags_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE debates_tags_id_seq OWNED BY debates_tags.id;


--
-- Name: friends; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE friends (
    id integer NOT NULL,
    user_id integer NOT NULL,
    friend_id integer NOT NULL
);


--
-- Name: friends_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE friends_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: friends_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE friends_id_seq OWNED BY friends.id;


--
-- Name: friends_pending; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE friends_pending (
    id integer NOT NULL,
    user_id integer NOT NULL,
    sent_by integer NOT NULL
);


--
-- Name: friends_pending_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE friends_pending_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: friends_pending_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE friends_pending_id_seq OWNED BY friends_pending.id;


--
-- Name: groups; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE groups (
    id integer NOT NULL,
    user_id integer NOT NULL,
    title character varying,
    created_ts integer NOT NULL,
    rate numeric(12,4) DEFAULT 0 NOT NULL,
    description text,
    photo_salt character varying(8),
    aims text,
    url character varying(255),
    type smallint DEFAULT 1 NOT NULL,
    teritory smallint DEFAULT 1 NOT NULL,
    fti tsvector
);


--
-- Name: groups_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE groups_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: groups_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE groups_id_seq OWNED BY groups.id;


--
-- Name: groups_members; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE groups_members (
    group_id integer NOT NULL,
    user_id integer NOT NULL
);


--
-- Name: groups_news; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE groups_news (
    id integer NOT NULL,
    group_id integer NOT NULL,
    text text NOT NULL,
    created_ts integer NOT NULL
);


--
-- Name: groups_news_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE groups_news_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: groups_news_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE groups_news_id_seq OWNED BY groups_news.id;


--
-- Name: groups_topics; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE groups_topics (
    id integer NOT NULL,
    group_id integer NOT NULL,
    topic character varying(255) NOT NULL,
    created_ts integer NOT NULL,
    messages_count smallint DEFAULT 0 NOT NULL,
    last_user_id integer NOT NULL,
    updated_ts integer NOT NULL
);


--
-- Name: groups_topics_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE groups_topics_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: groups_topics_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE groups_topics_id_seq OWNED BY groups_topics.id;


--
-- Name: groups_topics_messages; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE groups_topics_messages (
    id integer NOT NULL,
    topic_id integer NOT NULL,
    user_id integer NOT NULL,
    created_ts integer NOT NULL,
    text text NOT NULL
);


--
-- Name: groups_topics_messages_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE groups_topics_messages_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: groups_topics_messages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE groups_topics_messages_id_seq OWNED BY groups_topics_messages.id;


--
-- Name: ideas; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE ideas (
    id integer NOT NULL,
    user_id integer NOT NULL,
    segment integer NOT NULL,
    text text NOT NULL,
    created_ts integer NOT NULL,
    rate integer DEFAULT 0 NOT NULL,
    title character varying(255) DEFAULT ''::character varying NOT NULL,
    visible boolean DEFAULT true NOT NULL
);


--
-- Name: ideas_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE ideas_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: ideas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE ideas_id_seq OWNED BY ideas.id;


--
-- Name: messages; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE messages (
    id integer NOT NULL,
    owner integer NOT NULL,
    sender_id integer NOT NULL,
    receiver_id integer NOT NULL,
    body text NOT NULL,
    created_ts integer NOT NULL,
    thread_id integer NOT NULL,
    is_read boolean DEFAULT false NOT NULL
);


--
-- Name: messages_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE messages_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: messages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE messages_id_seq OWNED BY messages.id;


--
-- Name: messages_threads; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE messages_threads (
    id integer NOT NULL,
    sender_id integer NOT NULL,
    receiver_id integer NOT NULL
);


--
-- Name: messages_threads_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE messages_threads_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: messages_threads_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE messages_threads_id_seq OWNED BY messages_threads.id;


--
-- Name: parties; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE parties (
    id integer NOT NULL,
    user_id integer NOT NULL,
    title character varying,
    created_ts integer NOT NULL,
    rate numeric(12,4) DEFAULT 0 NOT NULL,
    description text,
    photo_salt character varying(8),
    aims text,
    url character varying(255),
    direction smallint DEFAULT 1 NOT NULL,
    trust integer DEFAULT 0 NOT NULL,
    not_trust integer DEFAULT 0 NOT NULL,
    direction_custom character varying(128),
    fti tsvector
);


--
-- Name: parties_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE parties_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: parties_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE parties_id_seq OWNED BY parties.id;


--
-- Name: parties_members; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE parties_members (
    user_id integer NOT NULL,
    party_id integer NOT NULL
);


--
-- Name: parties_news; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE parties_news (
    id integer NOT NULL,
    party_id integer NOT NULL,
    text text NOT NULL,
    created_ts integer NOT NULL
);


--
-- Name: parties_news_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE parties_news_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: parties_news_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE parties_news_id_seq OWNED BY parties_news.id;


--
-- Name: parties_program; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE parties_program (
    id integer NOT NULL,
    party_id integer NOT NULL,
    segment integer NOT NULL,
    text text NOT NULL,
    "for" integer DEFAULT 0 NOT NULL,
    against integer DEFAULT 0 NOT NULL
);


--
-- Name: parties_program_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE parties_program_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: parties_program_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE parties_program_id_seq OWNED BY parties_program.id;


--
-- Name: parties_topics; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE parties_topics (
    id integer NOT NULL,
    party_id integer NOT NULL,
    topic character varying(255) NOT NULL,
    created_ts integer NOT NULL,
    messages_count smallint DEFAULT 0 NOT NULL,
    last_user_id integer NOT NULL,
    updated_ts integer NOT NULL
);


--
-- Name: parties_topics_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE parties_topics_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: parties_topics_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE parties_topics_id_seq OWNED BY parties_topics.id;


--
-- Name: parties_topics_messages; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE parties_topics_messages (
    id integer NOT NULL,
    topic_id integer NOT NULL,
    user_id integer NOT NULL,
    created_ts integer NOT NULL,
    text text NOT NULL
);


--
-- Name: parties_topics_messages_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE parties_topics_messages_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: parties_topics_messages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE parties_topics_messages_id_seq OWNED BY parties_topics_messages.id;


--
-- Name: parties_trust; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE parties_trust (
    party_id integer NOT NULL,
    trust integer NOT NULL,
    not_trust integer NOT NULL,
    created_ts integer NOT NULL
);


--
-- Name: polls; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE polls (
    id integer NOT NULL,
    user_id integer NOT NULL,
    created_ts integer NOT NULL,
    question character varying NOT NULL,
    count integer DEFAULT 0 NOT NULL,
    is_multi boolean DEFAULT false NOT NULL,
    is_custom boolean DEFAULT false NOT NULL,
    visible boolean DEFAULT true NOT NULL,
    promoted boolean DEFAULT false NOT NULL,
    fti tsvector
);


--
-- Name: polls_answers; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE polls_answers (
    id integer NOT NULL,
    poll_id integer NOT NULL,
    answer character varying NOT NULL,
    count integer DEFAULT 0 NOT NULL
);


--
-- Name: polls_answers_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE polls_answers_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: polls_answers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE polls_answers_id_seq OWNED BY polls_answers.id;


--
-- Name: polls_custom; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE polls_custom (
    poll_id integer NOT NULL,
    user_id integer NOT NULL,
    text text NOT NULL
);


--
-- Name: polls_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE polls_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: polls_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE polls_id_seq OWNED BY polls.id;


--
-- Name: polls_votes; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE polls_votes (
    id integer NOT NULL,
    poll_id integer NOT NULL,
    answer_id integer NOT NULL,
    user_id integer NOT NULL
);


--
-- Name: polls_votes_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE polls_votes_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: polls_votes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE polls_votes_id_seq OWNED BY polls_votes.id;


--
-- Name: regions; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE regions (
    id integer NOT NULL,
    name_ru character varying(64) NOT NULL,
    name_ua character varying(64) NOT NULL
);


--
-- Name: regions_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE regions_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: regions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE regions_id_seq OWNED BY regions.id;


--
-- Name: user_auth; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE user_auth (
    id integer NOT NULL,
    email character varying(64) NOT NULL,
    password character varying(32) NOT NULL,
    security_code character varying(64) NOT NULL,
    active boolean NOT NULL,
    type smallint NOT NULL,
    credentials character varying DEFAULT ''::character varying NOT NULL,
    created_ts integer DEFAULT 0 NOT NULL
);


--
-- Name: user_auth_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE user_auth_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: user_auth_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE user_auth_id_seq OWNED BY user_auth.id;


--
-- Name: user_data; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE user_data (
    user_id integer NOT NULL,
    first_name character varying(64),
    last_name character varying(64),
    city_id integer DEFAULT 0,
    interests text,
    "position" character varying(64),
    segment character varying(64),
    photo_salt character varying(8),
    gender "char" DEFAULT 'm'::"char" NOT NULL,
    rate numeric(12,4) DEFAULT 0.0 NOT NULL,
    trust integer DEFAULT 0 NOT NULL,
    not_trust integer DEFAULT 0 NOT NULL,
    age integer DEFAULT 16 NOT NULL,
    notify boolean DEFAULT true NOT NULL,
    political_views smallint DEFAULT 0 NOT NULL,
    political_views_sub smallint DEFAULT 0 NOT NULL,
    political_views_custom character varying(128),
    show_political_views boolean DEFAULT true NOT NULL,
    fti tsvector
);


--
-- Name: user_questions; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE user_questions (
    id integer NOT NULL,
    profile_id integer NOT NULL,
    user_id integer NOT NULL,
    text text NOT NULL,
    rate integer DEFAULT 0 NOT NULL,
    reply text DEFAULT ''::text NOT NULL
);


--
-- Name: user_questions_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE user_questions_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- Name: user_questions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE user_questions_id_seq OWNED BY user_questions.id;


--
-- Name: user_trust; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE user_trust (
    user_id integer NOT NULL,
    trust integer DEFAULT 0 NOT NULL,
    not_trust integer DEFAULT 0 NOT NULL,
    created_ts integer NOT NULL
);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE blogs_comments ALTER COLUMN id SET DEFAULT nextval('blogs_comments_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE blogs_posts ALTER COLUMN id SET DEFAULT nextval('blogs_posts_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE blogs_tags ALTER COLUMN id SET DEFAULT nextval('blogs_tags_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE cities ALTER COLUMN id SET DEFAULT nextval('cities_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE debates ALTER COLUMN id SET DEFAULT nextval('debates_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE debates_arguments ALTER COLUMN id SET DEFAULT nextval('debates_arguments_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE debates_tags ALTER COLUMN id SET DEFAULT nextval('debates_tags_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE friends ALTER COLUMN id SET DEFAULT nextval('friends_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE friends_pending ALTER COLUMN id SET DEFAULT nextval('friends_pending_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE groups ALTER COLUMN id SET DEFAULT nextval('groups_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE groups_news ALTER COLUMN id SET DEFAULT nextval('groups_news_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE groups_topics ALTER COLUMN id SET DEFAULT nextval('groups_topics_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE groups_topics_messages ALTER COLUMN id SET DEFAULT nextval('groups_topics_messages_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ideas ALTER COLUMN id SET DEFAULT nextval('ideas_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE messages ALTER COLUMN id SET DEFAULT nextval('messages_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE messages_threads ALTER COLUMN id SET DEFAULT nextval('messages_threads_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE parties ALTER COLUMN id SET DEFAULT nextval('parties_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE parties_news ALTER COLUMN id SET DEFAULT nextval('parties_news_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE parties_program ALTER COLUMN id SET DEFAULT nextval('parties_program_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE parties_topics ALTER COLUMN id SET DEFAULT nextval('parties_topics_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE parties_topics_messages ALTER COLUMN id SET DEFAULT nextval('parties_topics_messages_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE polls ALTER COLUMN id SET DEFAULT nextval('polls_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE polls_answers ALTER COLUMN id SET DEFAULT nextval('polls_answers_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE polls_votes ALTER COLUMN id SET DEFAULT nextval('polls_votes_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE regions ALTER COLUMN id SET DEFAULT nextval('regions_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE user_auth ALTER COLUMN id SET DEFAULT nextval('user_auth_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE user_questions ALTER COLUMN id SET DEFAULT nextval('user_questions_id_seq'::regclass);


--
-- Name: blog_post_id; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY blogs_posts
    ADD CONSTRAINT blog_post_id PRIMARY KEY (id);


--
-- Name: blogs_comments_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY blogs_comments
    ADD CONSTRAINT blogs_comments_pkey PRIMARY KEY (id);


--
-- Name: blogs_posts_tags_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY blogs_posts_tags
    ADD CONSTRAINT blogs_posts_tags_pkey PRIMARY KEY (post_id, tag_id);


--
-- Name: blogs_tags_id; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY blogs_tags
    ADD CONSTRAINT blogs_tags_id PRIMARY KEY (id);


--
-- Name: cities_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY cities
    ADD CONSTRAINT cities_pkey PRIMARY KEY (id);


--
-- Name: debates_arguments_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY debates_arguments
    ADD CONSTRAINT debates_arguments_pkey PRIMARY KEY (id);


--
-- Name: debates_debates_tags_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY debates_debates_tags
    ADD CONSTRAINT debates_debates_tags_pkey PRIMARY KEY (debate_id, tag_id);


--
-- Name: debates_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY debates
    ADD CONSTRAINT debates_pkey PRIMARY KEY (id);


--
-- Name: debates_tags_id; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY debates_tags
    ADD CONSTRAINT debates_tags_id PRIMARY KEY (id);


--
-- Name: friends_pending_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY friends_pending
    ADD CONSTRAINT friends_pending_pkey PRIMARY KEY (id);


--
-- Name: friends_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY friends
    ADD CONSTRAINT friends_pkey PRIMARY KEY (id);


--
-- Name: groups_members_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY groups_members
    ADD CONSTRAINT groups_members_pkey PRIMARY KEY (group_id, user_id);


--
-- Name: groups_news_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY groups_news
    ADD CONSTRAINT groups_news_pkey PRIMARY KEY (id);


--
-- Name: groups_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY groups
    ADD CONSTRAINT groups_pkey PRIMARY KEY (id);


--
-- Name: groups_topics_messages_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY groups_topics_messages
    ADD CONSTRAINT groups_topics_messages_pkey PRIMARY KEY (id);


--
-- Name: groups_topics_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY groups_topics
    ADD CONSTRAINT groups_topics_pkey PRIMARY KEY (id);


--
-- Name: id; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY user_auth
    ADD CONSTRAINT id PRIMARY KEY (id);


--
-- Name: ideas_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY ideas
    ADD CONSTRAINT ideas_pkey PRIMARY KEY (id);


--
-- Name: messages_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY messages
    ADD CONSTRAINT messages_pkey PRIMARY KEY (id);


--
-- Name: messages_threads_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY messages_threads
    ADD CONSTRAINT messages_threads_pkey PRIMARY KEY (id);


--
-- Name: parties_members_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY parties_members
    ADD CONSTRAINT parties_members_pkey PRIMARY KEY (user_id);


--
-- Name: parties_news_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY parties_news
    ADD CONSTRAINT parties_news_pkey PRIMARY KEY (id);


--
-- Name: parties_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY parties
    ADD CONSTRAINT parties_pkey PRIMARY KEY (id);


--
-- Name: parties_program_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY parties_program
    ADD CONSTRAINT parties_program_pkey PRIMARY KEY (id);


--
-- Name: parties_topics_messages_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY parties_topics_messages
    ADD CONSTRAINT parties_topics_messages_pkey PRIMARY KEY (id);


--
-- Name: parties_topics_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY parties_topics
    ADD CONSTRAINT parties_topics_pkey PRIMARY KEY (id);


--
-- Name: polls_answers_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY polls_answers
    ADD CONSTRAINT polls_answers_pkey PRIMARY KEY (id);


--
-- Name: polls_custom_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY polls_custom
    ADD CONSTRAINT polls_custom_pkey PRIMARY KEY (poll_id, user_id);


--
-- Name: polls_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY polls
    ADD CONSTRAINT polls_pkey PRIMARY KEY (id);


--
-- Name: polls_votes_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY polls_votes
    ADD CONSTRAINT polls_votes_pkey PRIMARY KEY (id);


--
-- Name: regions_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY regions
    ADD CONSTRAINT regions_pkey PRIMARY KEY (id);


--
-- Name: user_id; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY user_data
    ADD CONSTRAINT user_id PRIMARY KEY (user_id);


--
-- Name: user_questions_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY user_questions
    ADD CONSTRAINT user_questions_pkey PRIMARY KEY (id);


--
-- Name: user_trust_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY user_trust
    ADD CONSTRAINT user_trust_pkey PRIMARY KEY (user_id, created_ts);


--
-- Name: blogs_comments_parent_id; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX blogs_comments_parent_id ON blogs_comments USING btree (parent_id);


--
-- Name: blogs_comments_post_id; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX blogs_comments_post_id ON blogs_comments USING btree (post_id);


--
-- Name: blogs_posts_created_ts; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX blogs_posts_created_ts ON blogs_posts USING btree (created_ts);


--
-- Name: blogs_posts_rate; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX blogs_posts_rate ON blogs_posts USING btree (rate);


--
-- Name: cities_name_ru; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX cities_name_ru ON cities USING btree (name_ru);


--
-- Name: cities_name_ua; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX cities_name_ua ON cities USING btree (name_ua);


--
-- Name: cities_region; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX cities_region ON cities USING btree (region_id);


--
-- Name: debate_argument_debate_id; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX debate_argument_debate_id ON debates_arguments USING btree (debate_id);


--
-- Name: debate_tag_id; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX debate_tag_id ON debates_debates_tags USING btree (tag_id, debate_id);


--
-- Name: debates_for_against; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX debates_for_against ON debates USING btree ("for", against);


--
-- Name: debates_tag_name; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX debates_tag_name ON debates_tags USING btree (name);


--
-- Name: debates_user_id; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX debates_user_id ON debates USING btree (user_id);


--
-- Name: friend_pengind_user_id; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX friend_pengind_user_id ON friends_pending USING btree (user_id);


--
-- Name: friend_user_id; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX friend_user_id ON friends USING btree (user_id, friend_id);


--
-- Name: groups_member_user; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX groups_member_user ON groups_members USING btree (user_id, group_id);


--
-- Name: groups_messages_topic; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX groups_messages_topic ON groups_topics_messages USING btree (topic_id);


--
-- Name: groups_news_group; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX groups_news_group ON groups_news USING btree (group_id);


--
-- Name: groups_rate; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX groups_rate ON groups USING btree (rate);


--
-- Name: groups_teritory_rate; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX groups_teritory_rate ON groups USING btree (teritory, rate);


--
-- Name: groups_topic_group; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX groups_topic_group ON groups_topics USING btree (group_id);


--
-- Name: groups_type_rate; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX groups_type_rate ON groups USING btree (type, rate);


--
-- Name: ideas_rate; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX ideas_rate ON ideas USING btree (rate);


--
-- Name: ideas_segment; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX ideas_segment ON ideas USING btree (segment, rate);


--
-- Name: ideas_user; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX ideas_user ON ideas USING btree (user_id);


--
-- Name: messages_owner_read; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX messages_owner_read ON messages USING btree (owner, is_read);


--
-- Name: name; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX name ON blogs_tags USING btree (name);


--
-- Name: parties_members_party; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX parties_members_party ON parties_members USING btree (party_id);


--
-- Name: parties_messages_topic; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX parties_messages_topic ON parties_topics_messages USING btree (topic_id);


--
-- Name: parties_news_party; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX parties_news_party ON parties_news USING btree (party_id);


--
-- Name: parties_program_party; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX parties_program_party ON parties_program USING btree (party_id);


--
-- Name: parties_program_segment_for; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX parties_program_segment_for ON parties_program USING btree (segment, "for", against);


--
-- Name: parties_rate; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX parties_rate ON parties USING btree (rate);


--
-- Name: parties_topics_party; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX parties_topics_party ON parties_topics USING btree (party_id, messages_count);


--
-- Name: parties_trust_created; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX parties_trust_created ON parties_trust USING btree (created_ts);


--
-- Name: polls_anwer_poll; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX polls_anwer_poll ON polls_answers USING btree (poll_id);


--
-- Name: polls_custom_user_id; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX polls_custom_user_id ON polls_custom USING btree (poll_id);


--
-- Name: polls_user; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX polls_user ON polls USING btree (user_id);


--
-- Name: polls_votes_poll; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX polls_votes_poll ON polls_votes USING btree (poll_id);


--
-- Name: user_auth_email; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX user_auth_email ON user_auth USING btree (email);


--
-- Name: user_auth_security_code; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX user_auth_security_code ON user_auth USING btree (security_code);


--
-- Name: user_auth_type; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX user_auth_type ON user_auth USING btree (type);


--
-- Name: user_id_indes; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX user_id_indes ON blogs_posts USING btree (user_id);


--
-- Name: user_questions_profile; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX user_questions_profile ON user_questions USING btree (profile_id, rate);


--
-- Name: public; Type: ACL; Schema: -; Owner: -
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

