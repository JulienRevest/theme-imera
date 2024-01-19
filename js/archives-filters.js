jQuery( function( $ ) {
	'use strict';

    var queryParams = new URLSearchParams(window.location.search);

    $(document).ready(function () {
        /** Set values after reload */
        if ( queryParams.has('media') ) {
            $( '#archiveFilterMedia' ).val( queryParams.get( 'media' ) );
        }
        if ( queryParams.has('category') ) {
            $( '#archiveFilterCategory' ).val( queryParams.get( 'category' ) );
        }
        if ( queryParams.has('disciplin') ) {
            $( '#archiveFilterDisciplin' ).val( queryParams.get( 'disciplin' ) );
        }
        if ( queryParams.has('range') ) {
            $( '#archiveFilterYear' ).val( queryParams.get( 'range' ) );
        }
        if ( queryParams.has('post_type') ) {
            $( '#searchFilterPostType' ).val( queryParams.get( 'post_type' ) );
        }
        if ( queryParams.has('search') ) {
            $( '#archive-search' ).val( queryParams.get( 'search' ) );
        }

        /** Selects events */
        $('#archiveFilterMedia').change(function() {
            setQueryParams( '#archiveFilterMedia', 'media' );
        })     
        $('#archiveFilterCategory').change(function() {
            setQueryParams( '#archiveFilterCategory', 'category' );
        })
        $('#archiveFilterDisciplin').change(function() {
            setQueryParams( '#archiveFilterDisciplin', 'disciplin' );
        })     
        $('#archiveFilterYear').change(function() {
            setQueryParams( '#archiveFilterYear', 'range' );
        })     
        $('#searchFilterPostType').change(function() {
            setQueryParams( '#searchFilterPostType', 'post_type' );
        })

        /** Searchbar events */
        $('.archive-search-button').on('click', function() {
            setQueryParams( '#archive-search', 'search' );
        });
        $('#archive-search').on('keypress', function(key) {
            if(key.which == 13) {
                setQueryParams( '#archive-search', 'search' );
            }
        });
    });
    
    /**
     * Add/Update query parameters
     * @param {String} input CSS Selector of the element to interact with
     * @param {String} queryParam Value to set in the query
     */
    function setQueryParams(input, queryParam) {
        if( $( input ).val() != "" ) {
            queryParams.set( queryParam, $( input ).val())
        } else {
            queryParams.delete( queryParam );
        }
        window.location.search = queryParams.toString();
    }

} );