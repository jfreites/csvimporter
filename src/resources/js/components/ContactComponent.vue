<template>
    <div class="container">
        
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Step 1: Upload CSV file</div>

                    <div class="card-body">
                        <label>File
                            <input type="file" class="" id="file" ref="file" v-on:change="handleFileUpload()"/>
                        </label>
                        <button class="btn btn-primary" v-on:click="submitFile()">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="records.length > 0" class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Step 2: Map fields</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>Original field</th>
                                <th>Importer Field</th>
                            </thead>
                            <tbody>
                                <tr v-for="(record, index) in this.records" :key="index">
                                    <td>{{ record }}</td>
                                    <td>
                                        <select v-model="match.selected[record]" name="match_field" class="form-control">
                                            <option 
                                                v-for="option in fieldOptions" 
                                                v-bind:value="option" 
                                                :key="option"
                                                :selected="option == record"
                                            >
                                                {{ option }}
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <button class="btn btn-primary" v-on:click="setMapping()">Continue</button>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="showMe" class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Step 3: Add contacts to Team</div>
                    <div class="card-body">
                        <select v-model="teamId" name="team_id" class="form-control">
                            <option value="1">Team 1</option>
                            <option value="2">Team 2</option>
                        </select>
                        <br>
                        <button class="btn btn-success" v-on:click="importContacts()">Import 50 contacts</button>
                        <div v-show="loading" class="loading">
                            loading...
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="showMeOnSuccess" class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="alert alert-success">
                    ALL CONTACTS IMPORTED!
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data(){
            return {
                file: '',
                records: [],
                showMe: false,
                loading: false,
                showMeOnSuccess: false,
                fieldOptions: [
                    'name',
                    'email',
                    'phone',
                    'other'
                ],
                match: {
                    selected: []
                },
                teamId: 1,
                fileName: ''
            }
        },
        mounted() {
            console.log('Component mounted.');
        },
        methods: {
            handleFileUpload() {
                // TODO: validate if a CSV file first...
                this.file = this.$refs.file.files[0];
            },
            submitFile() {
                let formData = new FormData();

                formData.append('file', this.file);
                // Extra data
                formData.append('team_id', '1');

                axios.post( '/upload-file', formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(result => {
                    this.records = result.data.headers;
                    this.fileName = result.data.file_name;
                }).catch(function(){
                    console.log('FAILURE!!');
                });
            },
            setMapping() {
                if (Object.keys(this.match.selected).length > 0) {
                    this.showMe = true;
                }
            },
            importContacts() {
                this.loading = true;
                let that = this;

                let entries = Object.entries(this.match.selected);
                //console.log(entries);
                let mapped = [];
                
                for (let i=0; i < entries.length; i++) {
                    let mapField = {original: entries[i][0], imported: entries[i][1]};
                    mapped.push(mapField);
                }

                let data = { 
                    mapped: mapped,
                    team_id: this.teamId,
                    file_name: this.fileName
                }
                
                axios.post( '/store-contacts', data)
                .then(result => {
                    console.log(result.data);
                    that.loading = false;
                    that.showMeOnSuccess = true;    
                })
                .catch(() => {
                    console.log('FAILURE!!');
                });
            }
        }
    }
</script>