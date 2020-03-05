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
-- Name: admin_feed; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE admin_feed (
    id integer NOT NULL,
    user_id integer NOT NULL,
    type smallint NOT NULL,
    created_ts integer NOT NULL,
    text text NOT NULL
);


ALTER TABLE public.admin_feed OWNER TO postgres;

--
-- Name: admin_feed_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE admin_feed_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.admin_feed_id_seq OWNER TO postgres;

--
-- Name: admin_feed_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE admin_feed_id_seq OWNED BY admin_feed.id;


--
-- Name: admin_feed_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('admin_feed_id_seq', 2741, true);


--
-- Name: blogs_comments; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
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


ALTER TABLE public.blogs_comments OWNER TO postgres;

--
-- Name: blogs_comments_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE blogs_comments_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.blogs_comments_id_seq OWNER TO postgres;

--
-- Name: blogs_comments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE blogs_comments_id_seq OWNED BY blogs_comments.id;


--
-- Name: blogs_comments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('blogs_comments_id_seq', 1033036, true);


--
-- Name: blogs_mentions; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE blogs_mentions (
    post_id integer NOT NULL,
    user_id integer NOT NULL
);


ALTER TABLE public.blogs_mentions OWNER TO postgres;

--
-- Name: blogs_posts; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE blogs_posts (
    id integer NOT NULL,
    user_id integer NOT NULL,
    title character varying(256),
    body text NOT NULL,
    created_ts integer NOT NULL,
    "for" integer DEFAULT 0 NOT NULL,
    text_rendered text NOT NULL,
    preview text NOT NULL,
    tags_text character varying,
    public boolean DEFAULT false NOT NULL,
    visible boolean DEFAULT true NOT NULL,
    fti tsvector,
    against integer DEFAULT 0 NOT NULL,
    type smallint DEFAULT 1 NOT NULL,
    views integer DEFAULT 0 NOT NULL,
    favorite boolean DEFAULT false NOT NULL,
    sort_ts integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.blogs_posts OWNER TO postgres;

--
-- Name: blogs_posts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE blogs_posts_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.blogs_posts_id_seq OWNER TO postgres;

--
-- Name: blogs_posts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE blogs_posts_id_seq OWNED BY blogs_posts.id;


--
-- Name: blogs_posts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('blogs_posts_id_seq', 92272, true);


--
-- Name: blogs_posts_tags; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE blogs_posts_tags (
    post_id integer NOT NULL,
    tag_id integer NOT NULL
);


ALTER TABLE public.blogs_posts_tags OWNER TO postgres;

--
-- Name: blogs_tags; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE blogs_tags (
    id integer NOT NULL,
    name character varying(64) NOT NULL
);


ALTER TABLE public.blogs_tags OWNER TO postgres;

--
-- Name: blogs_tags_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE blogs_tags_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.blogs_tags_id_seq OWNER TO postgres;

--
-- Name: blogs_tags_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE blogs_tags_id_seq OWNED BY blogs_tags.id;


--
-- Name: blogs_tags_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('blogs_tags_id_seq', 43406, true);


--
-- Name: bookmarks_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE bookmarks_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.bookmarks_id_seq OWNER TO postgres;

--
-- Name: bookmarks_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('bookmarks_id_seq', 43542, true);


--
-- Name: bookmarks; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE bookmarks (
    id integer DEFAULT nextval('bookmarks_id_seq'::regclass) NOT NULL,
    user_id integer NOT NULL,
    type smallint NOT NULL,
    oid integer NOT NULL
);


ALTER TABLE public.bookmarks OWNER TO postgres;

--
-- Name: candidates; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE candidates (
    user_id integer NOT NULL,
    program text
);


ALTER TABLE public.candidates OWNER TO postgres;

--
-- Name: candidates_forecast; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE candidates_forecast (
    user_id integer NOT NULL,
    candidate_id integer DEFAULT 0 NOT NULL,
    place integer DEFAULT 0 NOT NULL,
    votes integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.candidates_forecast OWNER TO postgres;

--
-- Name: candidates_votes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE candidates_votes (
    user_id integer NOT NULL,
    candidate_id integer NOT NULL,
    ip character varying(16) NOT NULL,
    ts integer NOT NULL
);


ALTER TABLE public.candidates_votes OWNER TO postgres;

--
-- Name: cities; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cities (
    id integer NOT NULL,
    region_id integer NOT NULL,
    name_ru character varying NOT NULL,
    name_ua character varying NOT NULL
);


ALTER TABLE public.cities OWNER TO postgres;

--
-- Name: cities_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cities_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.cities_id_seq OWNER TO postgres;

--
-- Name: cities_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cities_id_seq OWNED BY cities.id;


--
-- Name: cities_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cities_id_seq', 2419, true);


--
-- Name: comments_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE comments_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.comments_id_seq OWNER TO postgres;

--
-- Name: comments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('comments_id_seq', 608, true);


--
-- Name: comments; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE comments (
    id integer DEFAULT nextval('comments_id_seq'::regclass) NOT NULL,
    oid integer,
    otype smallint,
    user_id integer,
    text text,
    created_ts integer,
    parent_id integer DEFAULT 0 NOT NULL,
    childs text DEFAULT ''::text NOT NULL,
    rate integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.comments OWNER TO postgres;

--
-- Name: debates; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
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


ALTER TABLE public.debates OWNER TO postgres;

--
-- Name: debates_arguments; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
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


ALTER TABLE public.debates_arguments OWNER TO postgres;

--
-- Name: debates_arguments_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE debates_arguments_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.debates_arguments_id_seq OWNER TO postgres;

--
-- Name: debates_arguments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE debates_arguments_id_seq OWNED BY debates_arguments.id;


--
-- Name: debates_arguments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('debates_arguments_id_seq', 26737, true);


--
-- Name: debates_debates_tags; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE debates_debates_tags (
    debate_id integer NOT NULL,
    tag_id integer NOT NULL
);


ALTER TABLE public.debates_debates_tags OWNER TO postgres;

--
-- Name: debates_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE debates_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.debates_id_seq OWNER TO postgres;

--
-- Name: debates_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE debates_id_seq OWNED BY debates.id;


--
-- Name: debates_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('debates_id_seq', 1062, true);


--
-- Name: debates_tags; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE debates_tags (
    id integer NOT NULL,
    name character varying(64) NOT NULL
);


ALTER TABLE public.debates_tags OWNER TO postgres;

--
-- Name: debates_tags_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE debates_tags_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.debates_tags_id_seq OWNER TO postgres;

--
-- Name: debates_tags_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE debates_tags_id_seq OWNED BY debates_tags.id;


--
-- Name: debates_tags_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('debates_tags_id_seq', 1260, true);


--
-- Name: feed_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE feed_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.feed_id_seq OWNER TO postgres;

--
-- Name: feed_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('feed_id_seq', 7035780, true);


--
-- Name: feed; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE feed (
    id integer DEFAULT nextval('feed_id_seq'::regclass) NOT NULL,
    user_id integer NOT NULL,
    created_ts integer NOT NULL,
    actor integer NOT NULL,
    action smallint NOT NULL,
    section smallint DEFAULT 1 NOT NULL,
    text text NOT NULL,
    extra text
);


ALTER TABLE public.feed OWNER TO postgres;

--
-- Name: friends; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE friends (
    id integer NOT NULL,
    user_id integer NOT NULL,
    friend_id integer NOT NULL
);


ALTER TABLE public.friends OWNER TO postgres;

--
-- Name: friends_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE friends_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.friends_id_seq OWNER TO postgres;

--
-- Name: friends_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE friends_id_seq OWNED BY friends.id;


--
-- Name: friends_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('friends_id_seq', 62445, true);


--
-- Name: friends_pending; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE friends_pending (
    id integer NOT NULL,
    user_id integer NOT NULL,
    sent_by integer NOT NULL
);


ALTER TABLE public.friends_pending OWNER TO postgres;

--
-- Name: friends_pending_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE friends_pending_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.friends_pending_id_seq OWNER TO postgres;

--
-- Name: friends_pending_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE friends_pending_id_seq OWNED BY friends_pending.id;


--
-- Name: friends_pending_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('friends_pending_id_seq', 41434, true);


--
-- Name: groups; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
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
    fti tsvector,
    privacy smallint DEFAULT 1 NOT NULL
);


ALTER TABLE public.groups OWNER TO postgres;

--
-- Name: groups_applicants; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE groups_applicants (
    group_id integer NOT NULL,
    user_id integer NOT NULL
);


ALTER TABLE public.groups_applicants OWNER TO postgres;

--
-- Name: groups_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE groups_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.groups_id_seq OWNER TO postgres;

--
-- Name: groups_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE groups_id_seq OWNED BY groups.id;


--
-- Name: groups_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('groups_id_seq', 543, true);


--
-- Name: groups_members; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE groups_members (
    group_id integer NOT NULL,
    user_id integer NOT NULL
);


ALTER TABLE public.groups_members OWNER TO postgres;

--
-- Name: groups_news; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE groups_news (
    id integer NOT NULL,
    group_id integer NOT NULL,
    text text NOT NULL,
    created_ts integer NOT NULL
);


ALTER TABLE public.groups_news OWNER TO postgres;

--
-- Name: groups_news_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE groups_news_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.groups_news_id_seq OWNER TO postgres;

--
-- Name: groups_news_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE groups_news_id_seq OWNED BY groups_news.id;


--
-- Name: groups_news_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('groups_news_id_seq', 2072, true);


--
-- Name: groups_photo_comments_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE groups_photo_comments_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.groups_photo_comments_id_seq OWNER TO postgres;

--
-- Name: groups_photo_comments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('groups_photo_comments_id_seq', 672, true);


--
-- Name: groups_photo_comments; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE groups_photo_comments (
    id integer DEFAULT nextval('groups_photo_comments_id_seq'::regclass) NOT NULL,
    photo_id integer,
    user_id integer,
    text text,
    created_ts integer,
    parent_id integer DEFAULT 0 NOT NULL,
    childs text DEFAULT ''::text NOT NULL,
    rate integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.groups_photo_comments OWNER TO postgres;

--
-- Name: groups_photos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE groups_photos_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.groups_photos_id_seq OWNER TO postgres;

--
-- Name: groups_photos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('groups_photos_id_seq', 3334, true);


--
-- Name: groups_photos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE groups_photos (
    id integer DEFAULT nextval('groups_photos_id_seq'::regclass) NOT NULL,
    album_id integer DEFAULT 0 NOT NULL,
    group_id integer NOT NULL,
    salt integer NOT NULL,
    title character varying(255),
    user_id integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.groups_photos OWNER TO postgres;

--
-- Name: groups_photos_albums_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE groups_photos_albums_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.groups_photos_albums_id_seq OWNER TO postgres;

--
-- Name: groups_photos_albums_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('groups_photos_albums_id_seq', 151, true);


--
-- Name: groups_photos_albums; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE groups_photos_albums (
    id integer DEFAULT nextval('groups_photos_albums_id_seq'::regclass) NOT NULL,
    group_id integer NOT NULL,
    title character varying NOT NULL
);


ALTER TABLE public.groups_photos_albums OWNER TO postgres;

--
-- Name: groups_topics; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
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


ALTER TABLE public.groups_topics OWNER TO postgres;

--
-- Name: groups_topics_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE groups_topics_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.groups_topics_id_seq OWNER TO postgres;

--
-- Name: groups_topics_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE groups_topics_id_seq OWNED BY groups_topics.id;


--
-- Name: groups_topics_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('groups_topics_id_seq', 2873, true);


--
-- Name: groups_topics_messages; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE groups_topics_messages (
    id integer NOT NULL,
    topic_id integer NOT NULL,
    user_id integer NOT NULL,
    created_ts integer NOT NULL,
    text text NOT NULL
);


ALTER TABLE public.groups_topics_messages OWNER TO postgres;

--
-- Name: groups_topics_messages_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE groups_topics_messages_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.groups_topics_messages_id_seq OWNER TO postgres;

--
-- Name: groups_topics_messages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE groups_topics_messages_id_seq OWNED BY groups_topics_messages.id;


--
-- Name: groups_topics_messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('groups_topics_messages_id_seq', 10567, true);


--
-- Name: ideas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
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


ALTER TABLE public.ideas OWNER TO postgres;

--
-- Name: ideas_comments_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ideas_comments_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.ideas_comments_id_seq OWNER TO postgres;

--
-- Name: ideas_comments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ideas_comments_id_seq', 13966, true);


--
-- Name: ideas_comments; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ideas_comments (
    id integer DEFAULT nextval('ideas_comments_id_seq'::regclass) NOT NULL,
    idea_id integer,
    user_id integer,
    text text,
    created_ts integer,
    parent_id integer DEFAULT 0 NOT NULL,
    childs text DEFAULT ''::text NOT NULL,
    rate integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.ideas_comments OWNER TO postgres;

--
-- Name: ideas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ideas_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.ideas_id_seq OWNER TO postgres;

--
-- Name: ideas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ideas_id_seq OWNED BY ideas.id;


--
-- Name: ideas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ideas_id_seq', 1580, true);


--
-- Name: messages; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE messages (
    id integer NOT NULL,
    owner integer NOT NULL,
    sender_id integer NOT NULL,
    receiver_id integer NOT NULL,
    body text NOT NULL,
    created_ts integer NOT NULL,
    thread_id integer NOT NULL,
    is_read boolean DEFAULT false NOT NULL,
    attached text
);


ALTER TABLE public.messages OWNER TO postgres;

--
-- Name: messages_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE messages_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.messages_id_seq OWNER TO postgres;

--
-- Name: messages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE messages_id_seq OWNED BY messages.id;


--
-- Name: messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('messages_id_seq', 405063, true);


--
-- Name: messages_threads; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE messages_threads (
    id integer NOT NULL,
    sender_id integer NOT NULL,
    receiver_id integer NOT NULL
);


ALTER TABLE public.messages_threads OWNER TO postgres;

--
-- Name: messages_threads_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE messages_threads_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.messages_threads_id_seq OWNER TO postgres;

--
-- Name: messages_threads_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE messages_threads_id_seq OWNED BY messages_threads.id;


--
-- Name: messages_threads_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('messages_threads_id_seq', 74778, true);


--
-- Name: parties; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
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
    fti tsvector,
    contacts text,
    state character(3) DEFAULT 'new'::bpchar NOT NULL,
    vybory_2012 integer DEFAULT 0
);


ALTER TABLE public.parties OWNER TO postgres;

--
-- Name: parties_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE parties_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.parties_id_seq OWNER TO postgres;

--
-- Name: parties_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE parties_id_seq OWNED BY parties.id;


--
-- Name: parties_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('parties_id_seq', 207, true);


--
-- Name: parties_members; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE parties_members (
    user_id integer NOT NULL,
    party_id integer NOT NULL
);


ALTER TABLE public.parties_members OWNER TO postgres;

--
-- Name: parties_news; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE parties_news (
    id integer NOT NULL,
    party_id integer NOT NULL,
    text text NOT NULL,
    created_ts integer NOT NULL
);


ALTER TABLE public.parties_news OWNER TO postgres;

--
-- Name: parties_news_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE parties_news_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.parties_news_id_seq OWNER TO postgres;

--
-- Name: parties_news_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE parties_news_id_seq OWNED BY parties_news.id;


--
-- Name: parties_news_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('parties_news_id_seq', 1911, true);


--
-- Name: parties_program; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE parties_program (
    id integer NOT NULL,
    party_id integer NOT NULL,
    segment integer NOT NULL,
    text text NOT NULL,
    "for" integer DEFAULT 0 NOT NULL,
    against integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.parties_program OWNER TO postgres;

--
-- Name: parties_program_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE parties_program_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.parties_program_id_seq OWNER TO postgres;

--
-- Name: parties_program_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE parties_program_id_seq OWNED BY parties_program.id;


--
-- Name: parties_program_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('parties_program_id_seq', 1066, true);


--
-- Name: parties_topics; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
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


ALTER TABLE public.parties_topics OWNER TO postgres;

--
-- Name: parties_topics_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE parties_topics_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.parties_topics_id_seq OWNER TO postgres;

--
-- Name: parties_topics_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE parties_topics_id_seq OWNED BY parties_topics.id;


--
-- Name: parties_topics_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('parties_topics_id_seq', 116, true);


--
-- Name: parties_topics_messages; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE parties_topics_messages (
    id integer NOT NULL,
    topic_id integer NOT NULL,
    user_id integer NOT NULL,
    created_ts integer NOT NULL,
    text text NOT NULL
);


ALTER TABLE public.parties_topics_messages OWNER TO postgres;

--
-- Name: parties_topics_messages_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE parties_topics_messages_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.parties_topics_messages_id_seq OWNER TO postgres;

--
-- Name: parties_topics_messages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE parties_topics_messages_id_seq OWNED BY parties_topics_messages.id;


--
-- Name: parties_topics_messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('parties_topics_messages_id_seq', 337, true);


--
-- Name: parties_trust; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE parties_trust (
    party_id integer NOT NULL,
    trust integer NOT NULL,
    not_trust integer NOT NULL,
    created_ts integer NOT NULL
);


ALTER TABLE public.parties_trust OWNER TO postgres;

--
-- Name: polls; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
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


ALTER TABLE public.polls OWNER TO postgres;

--
-- Name: polls_answers; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE polls_answers (
    id integer NOT NULL,
    poll_id integer NOT NULL,
    answer character varying NOT NULL,
    count integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.polls_answers OWNER TO postgres;

--
-- Name: polls_answers_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE polls_answers_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.polls_answers_id_seq OWNER TO postgres;

--
-- Name: polls_answers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE polls_answers_id_seq OWNED BY polls_answers.id;


--
-- Name: polls_answers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('polls_answers_id_seq', 11973, true);


--
-- Name: polls_comments; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE polls_comments (
    id integer NOT NULL,
    poll_id integer,
    user_id integer,
    text text,
    created_ts integer,
    parent_id integer DEFAULT 0 NOT NULL,
    childs text DEFAULT ''::text NOT NULL,
    rate integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.polls_comments OWNER TO postgres;

--
-- Name: polls_comments_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE polls_comments_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.polls_comments_id_seq OWNER TO postgres;

--
-- Name: polls_comments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE polls_comments_id_seq OWNED BY polls_comments.id;


--
-- Name: polls_comments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('polls_comments_id_seq', 34180, true);


--
-- Name: polls_custom; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE polls_custom (
    poll_id integer NOT NULL,
    user_id integer NOT NULL,
    text text NOT NULL
);


ALTER TABLE public.polls_custom OWNER TO postgres;

--
-- Name: polls_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE polls_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.polls_id_seq OWNER TO postgres;

--
-- Name: polls_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE polls_id_seq OWNED BY polls.id;


--
-- Name: polls_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('polls_id_seq', 2611, true);


--
-- Name: polls_votes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE polls_votes (
    id integer NOT NULL,
    poll_id integer NOT NULL,
    answer_id integer NOT NULL,
    user_id integer NOT NULL
);


ALTER TABLE public.polls_votes OWNER TO postgres;

--
-- Name: polls_votes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE polls_votes_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.polls_votes_id_seq OWNER TO postgres;

--
-- Name: polls_votes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE polls_votes_id_seq OWNED BY polls_votes.id;


--
-- Name: polls_votes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('polls_votes_id_seq', 100369, true);


--
-- Name: rate_history_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE rate_history_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.rate_history_id_seq OWNER TO postgres;

--
-- Name: rate_history_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('rate_history_id_seq', 881384, true);


--
-- Name: rate_history; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE rate_history (
    id integer DEFAULT nextval('rate_history_id_seq'::regclass) NOT NULL,
    type smallint NOT NULL,
    object_id integer NOT NULL,
    user_id integer NOT NULL,
    rate smallint NOT NULL
);


ALTER TABLE public.rate_history OWNER TO postgres;

--
-- Name: regions; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE regions (
    id integer NOT NULL,
    name_ru character varying(64) NOT NULL,
    name_ua character varying(64) NOT NULL
);


ALTER TABLE public.regions OWNER TO postgres;

--
-- Name: regions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE regions_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.regions_id_seq OWNER TO postgres;

--
-- Name: regions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE regions_id_seq OWNED BY regions.id;


--
-- Name: regions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('regions_id_seq', 27, true);


--
-- Name: user_auth; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE user_auth (
    id integer NOT NULL,
    email character varying(64) NOT NULL,
    password character varying(32) NOT NULL,
    security_code character varying(64) NOT NULL,
    active boolean NOT NULL,
    type smallint NOT NULL,
    credentials character varying DEFAULT ''::character varying NOT NULL,
    created_ts integer DEFAULT 0 NOT NULL,
    ip character varying(24)
);


ALTER TABLE public.user_auth OWNER TO postgres;

--
-- Name: user_auth_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE user_auth_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.user_auth_id_seq OWNER TO postgres;

--
-- Name: user_auth_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE user_auth_id_seq OWNED BY user_auth.id;


--
-- Name: user_auth_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('user_auth_id_seq', 130408, true);


--
-- Name: user_data; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE user_data (
    user_id integer NOT NULL,
    first_name character varying(64),
    last_name character varying(64),
    city_id integer DEFAULT 0,
    interests text,
    "position" character varying(128),
    segment character varying(128),
    photo_salt character varying(8),
    gender "char" DEFAULT 'm'::"char" NOT NULL,
    rate numeric(12,4) DEFAULT 0.0 NOT NULL,
    trust integer DEFAULT 0 NOT NULL,
    not_trust integer DEFAULT 0 NOT NULL,
    age integer DEFAULT 16 NOT NULL,
    notify boolean DEFAULT true NOT NULL,
    political_views smallint DEFAULT 0 NOT NULL,
    political_views_sub smallint DEFAULT 0 NOT NULL,
    political_views_custom character varying(255),
    show_political_views boolean DEFAULT true NOT NULL,
    fti tsvector,
    contacts text DEFAULT ''::text NOT NULL,
    language character varying(2) DEFAULT 'ua'::character varying NOT NULL,
    bio text DEFAULT ''::text NOT NULL,
    fbid character varying(64)
);


ALTER TABLE public.user_data OWNER TO postgres;

--
-- Name: user_dictionary; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE user_dictionary (
    user_id integer NOT NULL,
    names text NOT NULL
);


ALTER TABLE public.user_dictionary OWNER TO postgres;

--
-- Name: user_log; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE user_log (
    user_id integer NOT NULL,
    ts integer NOT NULL,
    ip character varying(15)
);


ALTER TABLE public.user_log OWNER TO postgres;

--
-- Name: user_questions; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE user_questions (
    id integer NOT NULL,
    profile_id integer NOT NULL,
    user_id integer NOT NULL,
    text text NOT NULL,
    rate integer DEFAULT 0 NOT NULL,
    reply text DEFAULT ''::text NOT NULL
);


ALTER TABLE public.user_questions OWNER TO postgres;

--
-- Name: user_questions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE user_questions_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.user_questions_id_seq OWNER TO postgres;

--
-- Name: user_questions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE user_questions_id_seq OWNED BY user_questions.id;


--
-- Name: user_questions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('user_questions_id_seq', 1130, true);


--
-- Name: user_trust; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE user_trust (
    user_id integer NOT NULL,
    trust integer DEFAULT 0 NOT NULL,
    not_trust integer DEFAULT 0 NOT NULL,
    created_ts integer NOT NULL
);


ALTER TABLE public.user_trust OWNER TO postgres;

--
-- Name: votes2012; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE votes2012 (
    party_id integer NOT NULL,
    vkid bigint DEFAULT 0 NOT NULL,
    ts integer DEFAULT 0 NOT NULL,
    ua character varying(512) DEFAULT ''::character varying NOT NULL,
    ip character varying(32) DEFAULT 0 NOT NULL,
    id integer NOT NULL,
    user_id integer DEFAULT 0
);


ALTER TABLE public.votes2012 OWNER TO postgres;

--
-- Name: votes2012_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE votes2012_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.votes2012_id_seq OWNER TO postgres;

--
-- Name: votes2012_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE votes2012_id_seq OWNED BY votes2012.id;


--
-- Name: votes2012_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('votes2012_id_seq', 2747, true);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE admin_feed ALTER COLUMN id SET DEFAULT nextval('admin_feed_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE blogs_comments ALTER COLUMN id SET DEFAULT nextval('blogs_comments_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE blogs_posts ALTER COLUMN id SET DEFAULT nextval('blogs_posts_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE blogs_tags ALTER COLUMN id SET DEFAULT nextval('blogs_tags_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE cities ALTER COLUMN id SET DEFAULT nextval('cities_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE debates ALTER COLUMN id SET DEFAULT nextval('debates_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE debates_arguments ALTER COLUMN id SET DEFAULT nextval('debates_arguments_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE debates_tags ALTER COLUMN id SET DEFAULT nextval('debates_tags_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE friends ALTER COLUMN id SET DEFAULT nextval('friends_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE friends_pending ALTER COLUMN id SET DEFAULT nextval('friends_pending_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE groups ALTER COLUMN id SET DEFAULT nextval('groups_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE groups_news ALTER COLUMN id SET DEFAULT nextval('groups_news_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE groups_topics ALTER COLUMN id SET DEFAULT nextval('groups_topics_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE groups_topics_messages ALTER COLUMN id SET DEFAULT nextval('groups_topics_messages_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ideas ALTER COLUMN id SET DEFAULT nextval('ideas_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE messages ALTER COLUMN id SET DEFAULT nextval('messages_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE messages_threads ALTER COLUMN id SET DEFAULT nextval('messages_threads_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE parties ALTER COLUMN id SET DEFAULT nextval('parties_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE parties_news ALTER COLUMN id SET DEFAULT nextval('parties_news_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE parties_program ALTER COLUMN id SET DEFAULT nextval('parties_program_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE parties_topics ALTER COLUMN id SET DEFAULT nextval('parties_topics_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE parties_topics_messages ALTER COLUMN id SET DEFAULT nextval('parties_topics_messages_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE polls ALTER COLUMN id SET DEFAULT nextval('polls_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE polls_answers ALTER COLUMN id SET DEFAULT nextval('polls_answers_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE polls_comments ALTER COLUMN id SET DEFAULT nextval('polls_comments_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE polls_votes ALTER COLUMN id SET DEFAULT nextval('polls_votes_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE regions ALTER COLUMN id SET DEFAULT nextval('regions_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE user_auth ALTER COLUMN id SET DEFAULT nextval('user_auth_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE user_questions ALTER COLUMN id SET DEFAULT nextval('user_questions_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE votes2012 ALTER COLUMN id SET DEFAULT nextval('votes2012_id_seq'::regclass);


--
-- Data for Name: admin_feed; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY admin_feed (id, user_id, type, created_ts, text) FROM stdin;
\.


--
-- Data for Name: blogs_comments; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY blogs_comments (id, post_id, user_id, text, created_ts, parent_id, childs, rate) FROM stdin;
\.


--
-- Data for Name: blogs_mentions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY blogs_mentions (post_id, user_id) FROM stdin;
\.


--
-- Data for Name: blogs_posts; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY blogs_posts (id, user_id, title, body, created_ts, "for", text_rendered, preview, tags_text, public, visible, fti, against, type, views, favorite, sort_ts) FROM stdin;
\.


--
-- Data for Name: blogs_posts_tags; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY blogs_posts_tags (post_id, tag_id) FROM stdin;
\.


--
-- Data for Name: blogs_tags; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY blogs_tags (id, name) FROM stdin;
\.


--
-- Data for Name: bookmarks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY bookmarks (id, user_id, type, oid) FROM stdin;
\.


--
-- Data for Name: candidates; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY candidates (user_id, program) FROM stdin;
\.


--
-- Data for Name: candidates_forecast; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY candidates_forecast (user_id, candidate_id, place, votes) FROM stdin;
\.


--
-- Data for Name: candidates_votes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY candidates_votes (user_id, candidate_id, ip, ts) FROM stdin;
\.


--
-- Data for Name: cities; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cities (id, region_id, name_ru, name_ua) FROM stdin;
\.


--
-- Data for Name: comments; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY comments (id, oid, otype, user_id, text, created_ts, parent_id, childs, rate) FROM stdin;
\.


--
-- Data for Name: debates; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY debates (id, user_id, "for", against, created_ts, text, tags_text, visible, fti) FROM stdin;
\.


--
-- Data for Name: debates_arguments; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY debates_arguments (id, debate_id, user_id, created_ts, agree, text, childs, parent_id, rate, total) FROM stdin;
\.


--
-- Data for Name: debates_debates_tags; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY debates_debates_tags (debate_id, tag_id) FROM stdin;
\.


--
-- Data for Name: debates_tags; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY debates_tags (id, name) FROM stdin;
\.


--
-- Data for Name: feed; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY feed (id, user_id, created_ts, actor, action, section, text, extra) FROM stdin;
\.


--
-- Data for Name: friends; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY friends (id, user_id, friend_id) FROM stdin;
\.


--
-- Data for Name: friends_pending; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY friends_pending (id, user_id, sent_by) FROM stdin;
\.


--
-- Data for Name: groups; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY groups (id, user_id, title, created_ts, rate, description, photo_salt, aims, url, type, teritory, fti, privacy) FROM stdin;
\.


--
-- Data for Name: groups_applicants; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY groups_applicants (group_id, user_id) FROM stdin;
\.


--
-- Data for Name: groups_members; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY groups_members (group_id, user_id) FROM stdin;
\.


--
-- Data for Name: groups_news; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY groups_news (id, group_id, text, created_ts) FROM stdin;
\.


--
-- Data for Name: groups_photo_comments; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY groups_photo_comments (id, photo_id, user_id, text, created_ts, parent_id, childs, rate) FROM stdin;
\.


--
-- Data for Name: groups_photos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY groups_photos (id, album_id, group_id, salt, title, user_id) FROM stdin;
\.


--
-- Data for Name: groups_photos_albums; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY groups_photos_albums (id, group_id, title) FROM stdin;
\.


--
-- Data for Name: groups_topics; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY groups_topics (id, group_id, topic, created_ts, messages_count, last_user_id, updated_ts) FROM stdin;
\.


--
-- Data for Name: groups_topics_messages; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY groups_topics_messages (id, topic_id, user_id, created_ts, text) FROM stdin;
\.


--
-- Data for Name: ideas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ideas (id, user_id, segment, text, created_ts, rate, title, visible) FROM stdin;
\.


--
-- Data for Name: ideas_comments; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ideas_comments (id, idea_id, user_id, text, created_ts, parent_id, childs, rate) FROM stdin;
\.


--
-- Data for Name: messages; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY messages (id, owner, sender_id, receiver_id, body, created_ts, thread_id, is_read, attached) FROM stdin;
\.


--
-- Data for Name: messages_threads; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY messages_threads (id, sender_id, receiver_id) FROM stdin;
\.


--
-- Data for Name: parties; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY parties (id, user_id, title, created_ts, rate, description, photo_salt, aims, url, direction, trust, not_trust, direction_custom, fti, contacts, state, vybory_2012) FROM stdin;
\.


--
-- Data for Name: parties_members; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY parties_members (user_id, party_id) FROM stdin;
\.


--
-- Data for Name: parties_news; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY parties_news (id, party_id, text, created_ts) FROM stdin;
\.


--
-- Data for Name: parties_program; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY parties_program (id, party_id, segment, text, "for", against) FROM stdin;
\.


--
-- Data for Name: parties_topics; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY parties_topics (id, party_id, topic, created_ts, messages_count, last_user_id, updated_ts) FROM stdin;
\.


--
-- Data for Name: parties_topics_messages; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY parties_topics_messages (id, topic_id, user_id, created_ts, text) FROM stdin;
\.


--
-- Data for Name: parties_trust; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY parties_trust (party_id, trust, not_trust, created_ts) FROM stdin;
\.


--
-- Data for Name: polls; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY polls (id, user_id, created_ts, question, count, is_multi, is_custom, visible, promoted, fti) FROM stdin;
\.


--
-- Data for Name: polls_answers; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY polls_answers (id, poll_id, answer, count) FROM stdin;
\.


--
-- Data for Name: polls_comments; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY polls_comments (id, poll_id, user_id, text, created_ts, parent_id, childs, rate) FROM stdin;
\.


--
-- Data for Name: polls_custom; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY polls_custom (poll_id, user_id, text) FROM stdin;
\.


--
-- Data for Name: polls_votes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY polls_votes (id, poll_id, answer_id, user_id) FROM stdin;
\.


--
-- Data for Name: rate_history; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY rate_history (id, type, object_id, user_id, rate) FROM stdin;
\.


--
-- Data for Name: regions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY regions (id, name_ru, name_ua) FROM stdin;
\.


--
-- Data for Name: user_auth; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY user_auth (id, email, password, security_code, active, type, credentials, created_ts, ip) FROM stdin;
\.


--
-- Data for Name: user_data; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY user_data (user_id, first_name, last_name, city_id, interests, "position", segment, photo_salt, gender, rate, trust, not_trust, age, notify, political_views, political_views_sub, political_views_custom, show_political_views, fti, contacts, language, bio, fbid) FROM stdin;
\.


--
-- Data for Name: user_dictionary; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY user_dictionary (user_id, names) FROM stdin;
\.


--
-- Data for Name: user_log; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY user_log (user_id, ts, ip) FROM stdin;
\.


--
-- Data for Name: user_questions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY user_questions (id, profile_id, user_id, text, rate, reply) FROM stdin;
\.


--
-- Data for Name: user_trust; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY user_trust (user_id, trust, not_trust, created_ts) FROM stdin;
\.


--
-- Data for Name: votes2012; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY votes2012 (party_id, vkid, ts, ua, ip, id, user_id) FROM stdin;
\.


--
-- Name: admin_feed_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY admin_feed
    ADD CONSTRAINT admin_feed_pk PRIMARY KEY (id);


--
-- Name: blog_post_id; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY blogs_posts
    ADD CONSTRAINT blog_post_id PRIMARY KEY (id);


--
-- Name: blogs_comments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY blogs_comments
    ADD CONSTRAINT blogs_comments_pkey PRIMARY KEY (id);


--
-- Name: blogs_mentions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY blogs_mentions
    ADD CONSTRAINT blogs_mentions_pkey PRIMARY KEY (post_id, user_id);


--
-- Name: blogs_posts_tags_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY blogs_posts_tags
    ADD CONSTRAINT blogs_posts_tags_pkey PRIMARY KEY (post_id, tag_id);


--
-- Name: blogs_tags_id; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY blogs_tags
    ADD CONSTRAINT blogs_tags_id PRIMARY KEY (id);


--
-- Name: bookmarks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY bookmarks
    ADD CONSTRAINT bookmarks_pkey PRIMARY KEY (id);


--
-- Name: bookmarks_unique; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY bookmarks
    ADD CONSTRAINT bookmarks_unique UNIQUE (user_id, type, oid);


--
-- Name: candidate_forecast_user; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY candidates_forecast
    ADD CONSTRAINT candidate_forecast_user PRIMARY KEY (user_id, candidate_id);


--
-- Name: candidate_user; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY candidates
    ADD CONSTRAINT candidate_user PRIMARY KEY (user_id);


--
-- Name: candidate_vote; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY candidates_votes
    ADD CONSTRAINT candidate_vote PRIMARY KEY (user_id, candidate_id);


--
-- Name: cities_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cities
    ADD CONSTRAINT cities_pkey PRIMARY KEY (id);


--
-- Name: comments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY comments
    ADD CONSTRAINT comments_pkey PRIMARY KEY (id);


--
-- Name: debates_arguments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY debates_arguments
    ADD CONSTRAINT debates_arguments_pkey PRIMARY KEY (id);


--
-- Name: debates_debates_tags_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY debates_debates_tags
    ADD CONSTRAINT debates_debates_tags_pkey PRIMARY KEY (debate_id, tag_id);


--
-- Name: debates_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY debates
    ADD CONSTRAINT debates_pkey PRIMARY KEY (id);


--
-- Name: debates_tags_id; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY debates_tags
    ADD CONSTRAINT debates_tags_id PRIMARY KEY (id);


--
-- Name: feed_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY feed
    ADD CONSTRAINT feed_pkey PRIMARY KEY (id);


--
-- Name: friends_pending_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY friends_pending
    ADD CONSTRAINT friends_pending_pkey PRIMARY KEY (id);


--
-- Name: friends_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY friends
    ADD CONSTRAINT friends_pkey PRIMARY KEY (id);


--
-- Name: groups_applicants_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY groups_applicants
    ADD CONSTRAINT groups_applicants_pkey PRIMARY KEY (group_id, user_id);


--
-- Name: groups_members_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY groups_members
    ADD CONSTRAINT groups_members_pkey PRIMARY KEY (group_id, user_id);


--
-- Name: groups_news_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY groups_news
    ADD CONSTRAINT groups_news_pkey PRIMARY KEY (id);


--
-- Name: groups_photo_comments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY groups_photo_comments
    ADD CONSTRAINT groups_photo_comments_pkey PRIMARY KEY (id);


--
-- Name: groups_photos_albums_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY groups_photos_albums
    ADD CONSTRAINT groups_photos_albums_pkey PRIMARY KEY (id);


--
-- Name: groups_photos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY groups_photos
    ADD CONSTRAINT groups_photos_pkey PRIMARY KEY (id);


--
-- Name: groups_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY groups
    ADD CONSTRAINT groups_pkey PRIMARY KEY (id);


--
-- Name: groups_topics_messages_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY groups_topics_messages
    ADD CONSTRAINT groups_topics_messages_pkey PRIMARY KEY (id);


--
-- Name: groups_topics_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY groups_topics
    ADD CONSTRAINT groups_topics_pkey PRIMARY KEY (id);


--
-- Name: id; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY user_auth
    ADD CONSTRAINT id PRIMARY KEY (id);


--
-- Name: ideas_comments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ideas_comments
    ADD CONSTRAINT ideas_comments_pkey PRIMARY KEY (id);


--
-- Name: ideas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ideas
    ADD CONSTRAINT ideas_pkey PRIMARY KEY (id);


--
-- Name: messages_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY messages
    ADD CONSTRAINT messages_pkey PRIMARY KEY (id);


--
-- Name: messages_threads_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY messages_threads
    ADD CONSTRAINT messages_threads_pkey PRIMARY KEY (id);


--
-- Name: parties_members_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY parties_members
    ADD CONSTRAINT parties_members_pkey PRIMARY KEY (user_id);


--
-- Name: parties_news_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY parties_news
    ADD CONSTRAINT parties_news_pkey PRIMARY KEY (id);


--
-- Name: parties_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY parties
    ADD CONSTRAINT parties_pkey PRIMARY KEY (id);


--
-- Name: parties_program_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY parties_program
    ADD CONSTRAINT parties_program_pkey PRIMARY KEY (id);


--
-- Name: parties_topics_messages_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY parties_topics_messages
    ADD CONSTRAINT parties_topics_messages_pkey PRIMARY KEY (id);


--
-- Name: parties_topics_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY parties_topics
    ADD CONSTRAINT parties_topics_pkey PRIMARY KEY (id);


--
-- Name: polls_answers_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY polls_answers
    ADD CONSTRAINT polls_answers_pkey PRIMARY KEY (id);


--
-- Name: polls_comments_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY polls_comments
    ADD CONSTRAINT polls_comments_pk PRIMARY KEY (id);


--
-- Name: polls_custom_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY polls_custom
    ADD CONSTRAINT polls_custom_pkey PRIMARY KEY (poll_id, user_id);


--
-- Name: polls_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY polls
    ADD CONSTRAINT polls_pkey PRIMARY KEY (id);


--
-- Name: polls_votes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY polls_votes
    ADD CONSTRAINT polls_votes_pkey PRIMARY KEY (id);


--
-- Name: rate_history_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY rate_history
    ADD CONSTRAINT rate_history_pkey PRIMARY KEY (id);


--
-- Name: regions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY regions
    ADD CONSTRAINT regions_pkey PRIMARY KEY (id);


--
-- Name: user_dictionaty_user; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY user_dictionary
    ADD CONSTRAINT user_dictionaty_user PRIMARY KEY (user_id);


--
-- Name: user_id; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY user_data
    ADD CONSTRAINT user_id PRIMARY KEY (user_id);


--
-- Name: user_questions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY user_questions
    ADD CONSTRAINT user_questions_pkey PRIMARY KEY (id);


--
-- Name: user_trust_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY user_trust
    ADD CONSTRAINT user_trust_pkey PRIMARY KEY (user_id, created_ts);


--
-- Name: blogs_comments_parent_id; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX blogs_comments_parent_id ON blogs_comments USING btree (parent_id);


--
-- Name: blogs_comments_post_id; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX blogs_comments_post_id ON blogs_comments USING btree (post_id);


--
-- Name: blogs_posts_created; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX blogs_posts_created ON blogs_posts USING btree (created_ts, id);


--
-- Name: blogs_posts_created_ts; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX blogs_posts_created_ts ON blogs_posts USING btree (created_ts);


--
-- Name: blogs_posts_filters; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX blogs_posts_filters ON blogs_posts USING btree (type, visible);


--
-- Name: blogs_posts_rate; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX blogs_posts_rate ON blogs_posts USING btree ("for");


--
-- Name: blogs_posts_sort; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX blogs_posts_sort ON blogs_posts USING btree (sort_ts);


--
-- Name: blogs_posts_tags_tag; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX blogs_posts_tags_tag ON blogs_posts_tags USING btree (tag_id);


--
-- Name: candidate_vote_index; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX candidate_vote_index ON candidates_votes USING btree (candidate_id);


--
-- Name: cities_name_ru; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX cities_name_ru ON cities USING btree (name_ru);


--
-- Name: cities_name_ua; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX cities_name_ua ON cities USING btree (name_ua);


--
-- Name: cities_region; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX cities_region ON cities USING btree (region_id);


--
-- Name: comments_oidid; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX comments_oidid ON comments USING btree (otype, oid);


--
-- Name: comments_parent_id; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX comments_parent_id ON comments USING btree (parent_id);


--
-- Name: debate_argument_debate_id; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX debate_argument_debate_id ON debates_arguments USING btree (debate_id);


--
-- Name: debate_tag_id; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX debate_tag_id ON debates_debates_tags USING btree (tag_id, debate_id);


--
-- Name: debates_for_against; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX debates_for_against ON debates USING btree ("for", against);


--
-- Name: debates_tag_name; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX debates_tag_name ON debates_tags USING btree (name);


--
-- Name: debates_user_id; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX debates_user_id ON debates USING btree (user_id);


--
-- Name: feed_user_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX feed_user_idx ON feed USING btree (user_id);


--
-- Name: friend_pengind_user_id; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX friend_pengind_user_id ON friends_pending USING btree (user_id);


--
-- Name: friend_user_id; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX friend_user_id ON friends USING btree (user_id, friend_id);


--
-- Name: groups_member_user; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX groups_member_user ON groups_members USING btree (user_id, group_id);


--
-- Name: groups_messages_topic; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX groups_messages_topic ON groups_topics_messages USING btree (topic_id);


--
-- Name: groups_news_group; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX groups_news_group ON groups_news USING btree (group_id);


--
-- Name: groups_photo_comments_parent_id; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX groups_photo_comments_parent_id ON groups_photo_comments USING btree (parent_id);


--
-- Name: groups_photo_comments_photo_id; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX groups_photo_comments_photo_id ON groups_photo_comments USING btree (photo_id);


--
-- Name: groups_rate; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX groups_rate ON groups USING btree (rate);


--
-- Name: groups_teritory_rate; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX groups_teritory_rate ON groups USING btree (teritory, rate);


--
-- Name: groups_topic_group; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX groups_topic_group ON groups_topics USING btree (group_id);


--
-- Name: groups_type_rate; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX groups_type_rate ON groups USING btree (type, rate);


--
-- Name: ideas_comments_id; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ideas_comments_id ON ideas_comments USING btree (idea_id);


--
-- Name: ideas_comments_parent_id; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ideas_comments_parent_id ON ideas_comments USING btree (parent_id);


--
-- Name: ideas_rate; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ideas_rate ON ideas USING btree (rate);


--
-- Name: ideas_segment; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ideas_segment ON ideas USING btree (segment, rate);


--
-- Name: ideas_user; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ideas_user ON ideas USING btree (user_id);


--
-- Name: messages_owner_read; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX messages_owner_read ON messages USING btree (owner, is_read);


--
-- Name: name; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX name ON blogs_tags USING btree (name);


--
-- Name: parties_members_party; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX parties_members_party ON parties_members USING btree (party_id);


--
-- Name: parties_messages_topic; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX parties_messages_topic ON parties_topics_messages USING btree (topic_id);


--
-- Name: parties_news_party; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX parties_news_party ON parties_news USING btree (party_id);


--
-- Name: parties_program_party; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX parties_program_party ON parties_program USING btree (party_id);


--
-- Name: parties_program_segment_for; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX parties_program_segment_for ON parties_program USING btree (segment, "for", against);


--
-- Name: parties_rate; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX parties_rate ON parties USING btree (rate);


--
-- Name: parties_topics_party; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX parties_topics_party ON parties_topics USING btree (party_id, messages_count);


--
-- Name: parties_trust_created; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX parties_trust_created ON parties_trust USING btree (created_ts);


--
-- Name: polls_anwer_poll; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX polls_anwer_poll ON polls_answers USING btree (poll_id);


--
-- Name: polls_comments_parent_id; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX polls_comments_parent_id ON polls_comments USING btree (parent_id);


--
-- Name: polls_comments_poll_id; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX polls_comments_poll_id ON polls_comments USING btree (poll_id);


--
-- Name: polls_custom_user_id; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX polls_custom_user_id ON polls_custom USING btree (poll_id);


--
-- Name: polls_user; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX polls_user ON polls USING btree (user_id);


--
-- Name: polls_votes_poll; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX polls_votes_poll ON polls_votes USING btree (poll_id);


--
-- Name: user_auth_email; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX user_auth_email ON user_auth USING btree (email);


--
-- Name: user_auth_security_code; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX user_auth_security_code ON user_auth USING btree (security_code);


--
-- Name: user_auth_type; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX user_auth_type ON user_auth USING btree (type);


--
-- Name: user_id_indes; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX user_id_indes ON blogs_posts USING btree (user_id);


--
-- Name: user_log_user_ip_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX user_log_user_ip_pk ON user_log USING btree (user_id, ip);


--
-- Name: user_questions_profile; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX user_questions_profile ON user_questions USING btree (profile_id, rate);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

