S: symbol selectability ratio structure
	defines the score (integer) 0-100 that represents the random probability of selecting each of the sample's symbols
	
C: configuration,
	defines variables that set the test parameters and settings
	
	primary_data:{
		*variable id = (abbbreviated variable name) + (extra counting integers if necessary),
				ex:  mc0, mc1, mc2,
		mkcp01:{	//variable ID- used to pull the following from a variables configuration library
			variable_name: 'marketcap',
					variable_source: 'YahooFin.php',
					variable_function: 'MCap',
					captures: 'mkcp01',//should be same as id eventually, so delete this if not necessary. directory path of where fetches are cached, and named by timestamp
					renew_delay: 0,	//could change at any given time, between seconds, days...
					real-time//non-historical/(working title): 1,	//historical information is not available, this variable works in real time only.  so before each choice
				//end variable configuration
			}
	}
	selectability-factors:['mkcp01'],
	selectability-renew:'',
	
	sample_size: 40,
	population_name: 'technology-industry'
	population_id: 'ind-tch'
	
	start-date: '2016-01-01'
	end-date: '2016-03-30'
	
	period-name: 'Q1 of 2016'
	period-id: ''

T/  folder to collect each test iteration's results.
	